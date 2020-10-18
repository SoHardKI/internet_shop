<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 * @property string $title
 * @property string $article
 * @property integer $price
 * @property string $discription
 * @property string $image_url
 * @property integer $category_id
 */
class Product extends Model
{
    protected $fillable = [
        'title',
        'article',
        'price',
        'description',
        'image_url',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
