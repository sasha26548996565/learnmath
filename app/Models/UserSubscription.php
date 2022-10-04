<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserSubscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subscriptions(): Relation
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'subscription_id', 'subscriber_id');
    }

    public function subscribers(): Relation
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'subscriber_id', 'subscription_id');
    }
}
