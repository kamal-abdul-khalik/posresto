<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\Index;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_render_transaction_list()
    {
        $transaction = Transaction::factory()->create();

        Livewire::test(Index::class)
            ->assertSuccessful();
    }

    /** @test */
    public function can_search_transactions()
    {
        $transaction1 = Transaction::factory()->create(['invoice' => 'INV-001']);
        $transaction2 = Transaction::factory()->create(['invoice' => 'INV-002']);

        Livewire::test(Index::class)
            ->set('search', 'INV-001')
            ->assertSuccessful();

        $this->assertDatabaseHas('transactions', ['invoice' => 'INV-001']);
        $this->assertDatabaseHas('transactions', ['invoice' => 'INV-002']);
    }

    /** @test */
    public function can_filter_transactions_by_date()
    {
        $transaction1 = Transaction::factory()->create([
            'created_at' => now()->subDays(2)
        ]);
        $transaction2 = Transaction::factory()->create([
            'created_at' => now()
        ]);

        Livewire::test(Index::class)
            ->set('startDate', now()->format('Y-m-d'))
            ->set('endDate', now()->format('Y-m-d'))
            ->assertSuccessful();

        $this->assertDatabaseHas('transactions', ['id' => $transaction1->id]);
        $this->assertDatabaseHas('transactions', ['id' => $transaction2->id]);
    }
}
