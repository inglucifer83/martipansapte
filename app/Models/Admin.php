<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $avatar
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 */
class Admin extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'remember_token', 'avatar'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'date:d/m/Y'];
}