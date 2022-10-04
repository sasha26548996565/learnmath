<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'message' => $this->faker->sentence,
            'user_id' => User::get()->random()->id,
            'material_id' => Material::get()->random()->id
        ];
    }
}
