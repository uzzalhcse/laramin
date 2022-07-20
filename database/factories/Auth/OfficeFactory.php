<?php

namespace Database\Factories\Auth;

use App\Models\Auth\Office;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class OfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Office::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'office_type' => $this->faker->randomElement([1, 2]),
            'jurisdiction' => $this->faker->randomElement(['Division', 'District', 'Upazila']),
            'division_id' => 1,
            'district_id' => 1,
            'upazila_id' => 1,
            'union_id' => 1,
        ];
    }

}
