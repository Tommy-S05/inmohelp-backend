<?php

namespace Database\Factories;

use App\Models\Municipality;
use App\Models\Neighborhood;
use App\Models\PropertyStatus;
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
        $property_type_id = PropertyType::inRandomOrder()->value('id') ?: factory(PropertyType::class);

        $letters = PropertyType::select('code')->where('id', $property_type_id)->first();
        $code = $letters->code . rand(1000, 9999);
        return [
            'code' => $code,
            'name' => $this->faker->unique()->sentence(2),
            'slug' => $this->faker->unique()->slug,
            'user_id' => User::inRandomOrder()->value('id') ?: factory(User::class),
            'property_type_id' => $property_type_id,
//            'thumbnail' => $this->faker->imageUrl(640, 480, 'properties', true),
            'short_description' => $this->faker->paragraph(3),
            'description' => $this->faker->paragraph(12),
            'province_id' => Province::inRandomOrder()->value('id') ?: factory(Province::class),
            'municipality_id' => Municipality::inRandomOrder()->value('id') ?: factory(Municipality::class),
            'neighborhood_id' => Neighborhood::inRandomOrder()->value('id') ?: factory(Neighborhood::class),
            'address' => $this->faker->address,
            //            'map' => $this->faker->url,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'purpose' => $purpose,
            'price' => ($purpose == 'Venta') ? $this->faker->numberBetween(10000000, 50000000) : $this->faker->numberBetween(20000, 50000),
            'area' => $this->faker->numberBetween(50, 500),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'garages' => $this->faker->numberBetween(1, 3),
//            'status' => $this->faker->randomElement(['Nuevo', 'Usado', 'En Construcción', 'Sobre Planos', 'Remodelado']),
            'property_status_id' => PropertyStatus::inRandomOrder()->value('id') ?: factory(PropertyStatus::class),
            'floors' => $this->faker->numberBetween(1, 3),
            'views' => $this->faker->numberBetween(0, 100),
            'featured' => $this->faker->boolean(20),
            //            'sold' => $this->faker->boolean(20),
            //            'rent' => $this->faker->boolean(20),
            //            'available' => $this->faker->boolean(20),
            'negotiable' => $this->faker->boolean(20),
            'furnished' => $this->faker->boolean(20),
            'published' => $this->faker->boolean(90),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'year_built' => $this->faker->dateTimeBetween('-10 years', 'now'),
            //            'state' => $this->faker->randomElement(['NEW', 'LIKE NEW', 'USED']),
        ];
    }
}
