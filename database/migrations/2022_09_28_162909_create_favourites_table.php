<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('material_id')->constrained()->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favourites');
    }
};
