<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;   
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Customer;

#[Fillable(['transaction_number', 'customer_id', 'transaction_date', 'total_amount', 'notes'])]
class DepositTransaction extends Model
{
    use HasFactory;
    /**
     * Disable default timestamp handling because this table only stores created_at.
     */
    public $timestamps = false;

    /**
     * Get the customer that owns the transaction.
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

        static::created(function (DepositTransaction $transaction) {
            $transaction->updateQuietly([
                'transaction_number' => 'STR' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT),
            ]);

            if ($transaction->customer_id) {
                Customer::whereKey($transaction->customer_id)
                    ->increment('balance', $transaction->total_amount);
            }
        });

        static::updated(function (DepositTransaction $transaction) {
            if ($transaction->isDirty('total_amount') && $transaction->customer_id) {
                $originalAmount = $transaction->getOriginal('total_amount');
                $newAmount = $transaction->total_amount;
                $difference = $newAmount - $originalAmount;

                Customer::whereKey($transaction->customer_id)
                    ->increment('balance', $difference);
            }
        });

        static::deleted(function (DepositTransaction $transaction) {
            if ($transaction->customer_id) {
                Customer::whereKey($transaction->customer_id)
                    ->decrement('balance', $transaction->total_amount);
            }
        });
    }
}
