<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $guarded = [];

    public function category(): Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments(): Relation
    {
        return $this->hasMany(Comment::class, 'material_id', 'id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($material) {
            $material->slug = Str::slug($material->name) . '-' . now()->format('YmdHis');
            $material->user_id = Auth::user()->id;
        });

        static::updating(function ($material) {
            $material->slug = Str::slug($material->name) . '-' . now()->format('YmdHis');
        });
    }
}
