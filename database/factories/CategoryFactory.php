<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    /**
     * Mendefinisikan atribut yamg akan digunakan 
     * Pada faker()
     */
    public function definition()
    {
        $name = fake()->countryCode();
        $slug = Str::slug($name,'-');

        return [
            'name' => $name,
            'slug' => $slug
        ];
    }
}
