<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->word . rand(19, 190);
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
