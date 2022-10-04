<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function materials(): Relation
    {
        return $this->hasMany(Material::class, 'category_id', 'id');
    }

    public function user(): Relation
    {
        return $this->belongsToMany(User::class, 'subscription_categories', 'category_id', 'user_id');
    }

    public function scopeSlug($query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($category) {
            $category->slug = Str::slug($category->name) . '-' . now()->format('YmdHis');
        });
    }
}
