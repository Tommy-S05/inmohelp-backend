<?php

namespace Database\Factories;

use App\Models\Neighborhood;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purpose = $this->faker->randomElement(['Venta', 'Alquiler']);
        return [
            'code' => $this->faker->unique()->numberBetween(0001, 9999),
            'name' => $this->faker->unique()->sentence(2),
            'slug' => $this->faker->unique()->slug,
            //            'user_id' => 1,
            'user_id' => User::inRandomOrder()->value('id') ?: factory(User::class),
            //            "property_type_id" => 1,
            "property_type_id" => PropertyType::inRandomOrder()->value('id') ?: factory(PropertyType::class),
            'description' => $this->faker->paragraph(12),
            'province_id' => Province::inRandomOrder()->value('id') ?: factory(Province::class),
            'neighborhood_id' => Neighborhood::inRandomOrder()->value('id') ?: factory(Neighborhood::class),
            'address' => $this->faker->address,
            //            'map' => $this->faker->url,
            'purpose' => $purpose,
            'price' => ($purpose == 'Venta') ? $this->faker->numberBetween(10000000, 50000000) : $this->faker->numberBetween(20000, 50000),
            'area' => $this->faker->numberBetween(50, 500),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'garages' => $this->faker->numberBetween(1, 3),
            //            'floors' => $this->faker->numberBetween(1, 3),
            'views' => $this->faker->numberBetween(0, 100),
            'outstanding' => $this->faker->boolean(20),
            //            'sold' => $this->faker->boolean(20),
            //            'rent' => $this->faker->boolean(20),
            'furnished' => $this->faker->boolean(20),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            //            'state' => $this->faker->randomElement(['NEW', 'LIKE NEW', 'USED']),
            //            'category_id' => $this->faker->numberBetween(1, 5),
            //            'user_id' => $this->faker->numberBetween(1, 5),

        ];
    }
}
