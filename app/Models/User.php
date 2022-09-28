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

    public function subscriptions(): Relation
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'subscription_id', 'subscriber_id');
    }

    public function subscribers(): Relation
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'subscriber_id', 'subscription_id');
    }

    public function favouriteMaterials(): Relation
    {
        return $this->belongsToMany(Material::class, 'favourites', 'user_id', 'material_id');
    }

    public function isSubscriped(int $subscriberId): bool
    {
        return $this->subscribers->contains($subscriberId);
    }

    public function hasFavourite(int $materialId): bool
    {
        return $this->favouriteMaterials->contains($materialId);
    }
}
