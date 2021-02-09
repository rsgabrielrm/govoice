<?php

namespace Database\Factories;

use App\Models\Number;
use App\Models\NumberPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumberPreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NumberPreference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number_id' => Number::factory(),
            'auto_attendant' => true,
            'voicemail_enabled' => true,
            'name' => $this->faker->name,
            'value' => $this->faker->text(50),
        ];
    }
}
