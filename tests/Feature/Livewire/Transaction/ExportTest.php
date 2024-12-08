<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\Export;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_export_transactions()
    {
        Transaction::factory()->count(3)->create();

        Livewire::test(Export::class)
            ->set('startDate', now()->subDay()->format('Y-m-d'))
            ->set('endDate', now()->format('Y-m-d'))
            ->call('export')
            ->assertFileDownloaded('transactions.xlsx');
    }

    /** @test */
    public function validates_required_dates()
    {
        Livewire::test(Export::class)
            ->set('startDate', '')
            ->set('endDate', '')
            ->call('export')
            ->assertHasErrors(['startDate', 'endDate']);
    }

    /** @test */
    public function validates_date_range()
    {
        Livewire::test(Export::class)
            ->set('startDate', now()->addDays(2)->format('Y-m-d'))
            ->set('endDate', now()->format('Y-m-d'))
            ->call('export')
            ->assertHasErrors('startDate');
    }
}
