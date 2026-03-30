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
 * @property string $color
 * @property int $priority
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 */
class Tag extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = ['name', 'slug', 'description', 'color', 'priority'];
}