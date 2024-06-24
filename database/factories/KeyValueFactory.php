<?php

namespace Database\Factories;

use App\Models\KeyValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeyValue>
 */
class KeyValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\BaoPham\DynamoDb\DynamoDbModel>
     */
    protected $model = KeyValue::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->uuid(),
            'timestamp' => fake()->unixTime(),
            'value' => fake()->text(),
        ];
    }
}
