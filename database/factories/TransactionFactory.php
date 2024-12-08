<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'invoice' => 'INV-' . $this->faker->unique()->randomNumber(5),
            'customer_id' => null,
            'items' => [
                'Item 1' => [
                    'qty' => 2,
                    'price' => 25000
                ],
                'Item 2' => [
                    'qty' => 1,
                    'price' => 30000
                ]
            ],
            'total' => 80000,
            'desc' => $this->faker->sentence(),
            'payment_amount' => null,
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
