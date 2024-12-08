<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\Show;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_show_transaction_details()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000
        ]);

        Livewire::test(Show::class)
            ->call('showTransaction', $transaction)
            ->assertSet('transaction.id', $transaction->id)
            ->assertSet('modalShow', true);
    }

    /** @test */
    public function can_calculate_change_amount()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000
        ]);

        Livewire::test(Show::class)
            ->call('showTransaction', $transaction)
            ->set('paymentAmount', 100000)
            ->assertSet('changeAmount', 50000);
    }

    /** @test */
    public function saves_payment_amount_when_closing_modal()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000
        ]);

        Livewire::test(Show::class)
            ->call('showTransaction', $transaction)
            ->set('paymentAmount', 100000)
            ->call('savePayment');

        $this->assertEquals(100000, $transaction->fresh()->payment_amount);
    }

    /** @test */
    public function can_save_payment()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000,
            'is_done' => false,
            'payment_amount' => null
        ]);

        Livewire::test(Show::class)
            ->call('showTransaction', $transaction)
            ->set('paymentAmount', 100000)
            ->call('savePayment')
            ->assertDispatched('payment-saved', transactionId: $transaction->id);

        $transaction->refresh();
        $this->assertTrue($transaction->is_done);
        $this->assertEquals(100000, $transaction->payment_amount);
    }

    /** @test */
    public function cannot_save_payment_if_amount_is_zero()
    {
        $transaction = Transaction::factory()->create([
            'total' => 50000,
            'is_done' => false,
            'payment_amount' => null
        ]);

        Livewire::test(Show::class)
            ->call('showTransaction', $transaction)
            ->set('paymentAmount', 0)
            ->call('savePayment');

        $transaction->refresh();
        $this->assertFalse($transaction->is_done);
        $this->assertNull($transaction->payment_amount);
    }
}
