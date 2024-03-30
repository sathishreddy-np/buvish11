<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $names = ['color', 'size', 'weight', 'material', 'brand', 'style', 'pattern', 'type', 'shape', 'dimension', 'texture', 'condition', 'age', 'origin', 'gender', 'usage', 'category', 'model', 'quantity', 'availability'];
        $values = ['red', 'blue', 'green', 'yellow', 'black', 'white', 'small', 'medium', 'large', 'extra-large', 'light', 'dark', 'heavy', 'plastic', 'metal', 'cotton', 'wool', 'leather', 'summer', 'winter', 'casual', 'formal', 'sporty', 'striped', 'solid', 'printed', 'round', 'square', 'oval', 'rectangle', 'abstract', 'modern', 'vintage', 'new', 'used', 'unisex', 'male', 'female', 'indoor', 'outdoor', 'electronic', 'furniture', 'accessory', 'tool', 'stationary', 'grocery'];

        return [
            'team_id' => Team::factory(),
            'name' => fake()->randomElement($names),
        ];
    }
}
