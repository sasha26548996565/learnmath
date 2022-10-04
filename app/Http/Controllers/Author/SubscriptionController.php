<?php

declare(strict_types=1);

namespace App\Http\Controllers\Author;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\UserSubscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscription(User $author): RedirectResponse
    {
        UserSubscription::create(['subscription_id' => $author->id, 'subscriber_id' => Auth::user()->id]);
        return to_route('author.show', $author->email);
    }
}
