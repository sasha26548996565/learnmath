<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public const ROLE_READER = 'reader';
    public const ROLE_TEACHER = 'teacher';
    public const ROLE_ADMIN = 'admin';

    public const PERMISSION_ADD_MATERIAL = 'add-material';
    public const PERMISSION_DELETE_MATERIAL = 'delete-material';

    public function materials(): Relation
    {
        return $this->hasMany(Material::class, 'user_id', 'id');
    }

    public function comments(): Relation
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
