<?php

namespace Tests\Feature\Livewire\Transaction;

use App\Livewire\Transaction\Export;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_export_transactions()
    {
        $this->withoutExceptionHandling();

        Storage::fake('local');

        Transaction::factory()->count(3)->create();

        Livewire::test(Export::class)
            ->set('month', '2024-01')
            ->call('export')
            ->assertFileDownloaded('transactions-2024-01.xlsx');
    }

    /** @test */
    public function validates_required_month()
    {
        Livewire::test(Export::class)
            ->set('month', '')
            ->call('export')
            ->assertHasErrors(['month' => 'required']);
    }

    /** @test */
    public function validates_month_format()
    {
        Livewire::test(Export::class)
            ->set('month', 'invalid-date')
            ->call('export')
            ->assertHasErrors(['month' => 'date_format']);
    }
}
