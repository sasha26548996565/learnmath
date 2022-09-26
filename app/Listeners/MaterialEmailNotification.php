<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\SubscriptionCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MaterialEmailNotification
{
    private SubscriptionCategory $subscriptionCategory;

    public function __construct(SubscriptionCategory $subscriptionCategory)
    {
        $this->subscriptionCategory = $subscriptionCategory;
    }

    public function handle($event)
    {
        $subscriptions = $this->subscriptionCategory->all();

        foreach ($subscriptions as $subscription)
        {
            if ($subscription->category_id == $event->material->category->id)
            {
                $this->subscriptionCategory->sendEmailMaterial($event->material);
            }
        }
    }
}
