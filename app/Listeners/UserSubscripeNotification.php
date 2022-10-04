<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Jobs\SendMailMaterialJob;
use App\Mail\SendMaterialMail;
use App\Models\User;
use App\Models\Material;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSubscripeNotification
{
    public function handle($event)
    {
        $subscriptions = UserSubscription::all();

        foreach ($subscriptions as $subscription)
        {
            $subscriptionUser = User::find($subscription->subscription_id);
            if (($subscriptionUser->id == Auth::user()->id) && ($subscriptionUser->id == $event->material->user_id))
            {
                SendMailMaterialJob::dispatch($event->material, $subscriptionUser->email);
            }
        }
    }
}
