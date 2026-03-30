<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property int $parent_id
 * @property int $sort_order
 * @property string $seo_title
 * @property string $seo_description
 * @property int $is_active
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Product[] $products
 */
class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'description', 'image', 'parent_id', 'sort_order', 'seo_title', 'seo_description', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
}