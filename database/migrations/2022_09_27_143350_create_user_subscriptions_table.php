<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('subscription_id');
            $table->unsignedInteger('subscriber_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
