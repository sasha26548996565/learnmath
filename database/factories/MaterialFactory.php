<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->word . rand(19, 190);
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
            'content' => 'something',
            'category_id' => Category::get()->random()->id,
            'user_id' => User::get()->random()->id
        ];
    }
}
