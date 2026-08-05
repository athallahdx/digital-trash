<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['customer_number', 'name', 'balance', 'address', 'phone', 'is_active'])]
class Customer extends Model
{
    use HasFactory;

    /**
     * Get the deposit transactions for the customer.
     */
    public function depositTransactions(): HasMany
    {
        return $this->hasMany(DepositTransaction::class);
    }

    /**
     * Get the withdrawal transactions for the customer.
     */
    public function withdrawalTransactions(): HasMany
    {
        return $this->hasMany(WithdrawalTransaction::class);
    }

    /**
     * The attribute casts for the model.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Customer $customer) {
            if (empty($customer->customer_number)) {
                do {
                    $customerNumber = 'NSB' . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
                } while (Customer::where('customer_number', $customerNumber)->exists());

                $customer->customer_number = $customerNumber;
            }
        });
    }
}
