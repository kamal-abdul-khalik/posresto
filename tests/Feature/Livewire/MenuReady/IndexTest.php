<?php

namespace Tests\Feature\Livewire\MenuReady;

use App\Livewire\MenuReady\Index;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Index::class)
            ->assertOk();
    }

    /** @test */
    public function shows_only_not_ready_transactions()
    {
        // Create ready transaction
        $readyTransaction = Transaction::factory()->create([
            'is_ready' => true,
            'is_done' => true
        ]);

        // Create not ready transaction
        $notReadyTransaction = Transaction::factory()->create([
            'is_ready' => false,
            'is_done' => false
        ]);

        Livewire::test(Index::class)
            ->assertSee($notReadyTransaction->invoice)
            ->assertDontSee($readyTransaction->invoice);
    }

    /** @test */
    public function can_mark_transaction_as_ready()
    {
        $transaction = Transaction::factory()->create([
            'is_ready' => false
        ]);

        Livewire::test(Index::class)
            ->call('setReady', $transaction)
            ->assertDispatched('$refresh');

        $this->assertTrue($transaction->fresh()->is_ready);
    }

    /** @test */
    public function can_show_payment_modal()
    {
        $transaction = Transaction::factory()->create([
            'is_ready' => false,
            'is_done' => false
        ]);

        Livewire::test(Index::class)
            ->call('showModal', $transaction)
            ->assertDispatched('showTransaction', transaction: $transaction->id);
    }

    /** @test */
    public function marks_transaction_as_ready_after_payment()
    {
        $transaction = Transaction::factory()->create([
            'is_ready' => false,
            'is_done' => false
        ]);

        Livewire::test(Index::class)
            ->call('handlePaymentSaved', $transaction->id);

        $this->assertTrue($transaction->fresh()->is_ready);
    }

    /** @test */
    public function can_play_announcement()
    {
        $transaction = Transaction::factory()->create([
            'is_ready' => false
        ]);

        Livewire::test(Index::class)
            ->call('playAnnouncement', $transaction)
            ->assertDispatched('play-announcement');
    }
}
