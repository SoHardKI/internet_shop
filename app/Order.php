<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 * @property string $customer_name
 * @property string $customer_second_name
 * @property string $customer_email
 */
class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_second_name',
        'customer_email',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
