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
    public function definition(): array
    {
       $categories = [
    [
        'name' => 'Snacks & Confectionery',
        'description' => 'Biscuits, chips, chocolates, sweets, and other treats to keep your taste buds satisfied.',
    ],
    [
        'name' => 'Food Staples & Grains',
        'description' => 'Rice, beans, pasta, semovita, flour, and other everyday cooking essentials.',
    ],
    [
        'name' => 'Frozen & Canned Foods',
        'description' => 'Convenient frozen meats, vegetables, and canned goods ready for quick meal preparation.',
    ],
    [
        'name' => 'Toiletries & Personal Care',
        'description' => 'Bath soaps, deodorants, lotions, toothpaste, and grooming products to stay clean and confident.',
    ],
    [
        'name' => 'Household Essentials',
        'description' => 'Laundry detergents, cleaning agents, tissue papers, and air fresheners for a spotless home.',
    ],
];


    $category = $this->faker->randomElement($categories);

    return [
        'uuid' => Str::uuid(),
        'name' => $category['name'],
        'code' => strtoupper($this->faker->lexify('CAT-????')),
        'description' => $category['description'],
        'image' => null,
        'created_by' => 'Admin',
        'status' => true,
    ];

    }
}
