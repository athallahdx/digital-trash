<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;

#[Fillable(['transaction_number','customer_id', 'transaction_date', 'amount', 'notes'])]
class WithdrawalTransaction extends Model
{
    use HasFactory;
    /**
     * Disable default timestamp handling because this table only stores created_at.
     */
    public $timestamps = false;

    /**
     * Get the customer that owns the withdrawal transaction.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * The attribute casts for the model.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'transaction_date' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (WithdrawalTransaction $transaction) {
            if (! $transaction->customer_id) {
                return;
            }

            $customer = Customer::find($transaction->customer_id);
            if (! $customer) {
                return;
            }

            if ($customer->balance < $transaction->amount) {
                throw new \RuntimeException('Insufficient balance.');
            }
        });

        static::created(function (WithdrawalTransaction $transaction) {
            $transaction->updateQuietly([
                'transaction_number' => 'PNR' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            ]);

            if (! $transaction->customer_id) {
                return;
            }

            $customer = Customer::find($transaction->customer_id);
            if (! $customer) {
                return;
            }

            $customer->decrement('balance', $transaction->amount);
        });

        static::updated(function (WithdrawalTransaction $transaction) {
            if (! $transaction->customer_id) {
                return;
            }

            $customer = Customer::find($transaction->customer_id);
            if (! $customer) {
                return;
            }

            if ($transaction->isDirty('amount')) {
                $originalAmount = $transaction->getOriginal('amount');
                $newAmount = $transaction->amount;
                $difference = $newAmount - $originalAmount;

                if ($difference > 0 && $customer->balance < $difference) {
                    throw new \RuntimeException('Insufficient balance for the updated amount.');
                }

                $customer->decrement('balance', $difference);
            }
        });

        static::deleted(function (WithdrawalTransaction $transaction) {
            if (! $transaction->customer_id) {
                return;
            }

            $customer = Customer::find($transaction->customer_id);
            if (! $customer) {
                return;
            }

            $customer->increment('balance', $transaction->amount);
        });
    }
}
