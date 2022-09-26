<?php

declare(strict_types=1);

namespace App\Models;

use App\Jobs\SendMailMaterialByCategoryJob;
use App\Mail\SendMaterialByCategoryMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'subscription_categories';

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function scopeByActiveCategoryId($query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function sendEmailMaterial(Material $material)
    {
        $subscriptions = $this->byActiveCategoryId($material->category->id)->get();

        foreach ($subscriptions as $subscription)
        {
            SendMailMaterialByCategoryJob::dispatch($material, $subscription->user->email);
        }
    }
}
