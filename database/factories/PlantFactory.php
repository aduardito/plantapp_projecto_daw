<?php


// php artisan make:factory PlantFactory --model=Plant

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => 'El pachypodium lameri no se trata de una palmera, pero su presencia puede dar esa impresión. El tronco, con su característica hinchazón, es de un marrón grisáceo y está recubierto de afiladas espinas. Las flores, blanca y de pedúnculos dorados.',
            'image_url' => 'https://jardineriakuka.com/30053-large_default/pachypodium-lamerei.jpg',
            'user_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        ];
    }
}