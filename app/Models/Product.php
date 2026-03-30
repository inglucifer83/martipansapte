<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $slug
 * @property string $short_description_key_id
 * @property string $long_description
 * @property string $sku
 * @property double $price
 * @property double $sale_price
 * @property int $inventory_quantity
 * @property string $featured_image
 * @property string $seo_title_key_id
 * @property string $seo_description
 * @property double $weight
 * @property string $dimensions
 * @property string $shipping_class
 * @property int $featured_flag
 * @property string $status
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Image[] $images
 * @property Variant[] $variants
 * @property Review[] $reviews
 * @property Category[] $category
 */
class Product extends LocalizedModel
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['category_id', 'name', 'slug', 'short_description_key_id', 'long_description', 'sku', 'price', 'sale_price', 'inventory_quantity', 'featured_image', 'seo_title_key_id', 'seo_description', 'weight', 'dimensions', 'shipping_class', 'featured_flag', 'status'];
    protected $casts = ['featured_flag' => 'boolean'];
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants()
    {
        return $this->hasMany('App\Models\Variant', 'product_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'product_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}