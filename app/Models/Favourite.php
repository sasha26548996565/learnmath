<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Favourite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): Relation
    {
        return $this->belongsToMany(User::class, 'favourites', 'material_id', 'user_id');
    }

    public function material(): Relation
    {
        return $this->belongsToMany(User::class, 'favourites', 'user_id', 'material_id');
    }
}
