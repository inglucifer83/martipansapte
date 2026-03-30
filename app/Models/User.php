<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $avatar
 * @property string $display_name
 * @property string $phone
 * @property Carbon|string $email_verified_at
 * @property int $marketing_opt_in
 * @property Carbon|string $last_login_at
 * @property string $role
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Order[] $orders
 * @property Cart[] $carts
 * @property Review[] $reviews
 * @property Address[] $addresses
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'avatar', 'display_name', 'phone', 'email_verified_at', 'marketing_opt_in', 'last_login_at', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['last_login_at' => 'date:d/m/Y'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart', 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'user_id');
    }
}