<?php

namespace Database\Factories\Auth;

use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roleName = $this->faker->randomElement(['Super Admin', 'Officer']);
        $roleSlug = Str::slug($roleName);
        return [
            'name' => $roleName,
            'slug' => $roleSlug,
        ];
    }
}
