<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\Actions;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ActionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_show_transaction_actions()
    {
        $transaction = Transaction::factory()->create();

        Livewire::test(Actions::class, ['transaction' => $transaction])
            ->assertSuccessful();
    }

    /** @test */
    public function can_emit_show_transaction_event()
    {
        $transaction = Transaction::factory()->create();

        Livewire::test(Actions::class, ['transaction' => $transaction])
            ->call('showTransaction')
            ->assertDispatched('showTransaction');
    }

    /** @test */
    public function can_navigate_to_receipt()
    {
        $transaction = Transaction::factory()->create();

        Livewire::test(Actions::class, ['transaction' => $transaction])
            ->call('printReceipt')
            ->assertRedirect(route('transaction.receipt', $transaction));
    }
}
