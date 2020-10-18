<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderDetail
 * @package App
 * @property integer $order_id
 * @property integer $product
 * @property integer $count
 */
class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'count',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
