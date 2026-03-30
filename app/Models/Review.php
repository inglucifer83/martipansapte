<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $rating
 * @property string $title
 * @property string $body
 * @property int $approved
 * @property int $helpful_count
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property User[] $user
 * @property Product[] $product
 */
class Review extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['user_id', 'product_id', 'rating', 'title', 'body', 'approved', 'helpful_count'];
    protected $casts = ['approved' => 'boolean'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}