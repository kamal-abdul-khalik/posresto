<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\Receipt;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReceiptTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_show_receipt()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000,
            'payment_amount' => 100000
        ]);

        Livewire::test(Receipt::class, ['transaction' => $transaction])
            ->assertSet('transaction.id', $transaction->id)
            ->assertSet('paymentAmount', 100000)
            ->assertSee('Rp. 50.000')  // Total
            ->assertSee('Rp. 100.000') // Payment Amount
            ->assertSee('Rp. 50.000'); // Change Amount
    }

    /** @test */
    public function handles_null_payment_amount()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000,
            'payment_amount' => null
        ]);

        Livewire::test(Receipt::class, ['transaction' => $transaction])
            ->assertSet('paymentAmount', 0);
    }
}
