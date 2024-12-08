<?php

namespace App\Livewire\Transaction;

use App\Exports\TransactionExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public $month;

    public function export()
    {
        $this->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        // Convert month to start and end date
        $date = \Carbon\Carbon::createFromFormat('Y-m', $this->month);
        $startDate = $date->startOfMonth()->format('Y-m-d');
        $endDate = $date->endOfMonth()->format('Y-m-d');

        return Excel::download(
            new TransactionExport($startDate, $endDate),
            'transactions-' . $this->month . '.xlsx'
        );
    }

    public function mount()
    {
        // Set default month to current month
        $this->month = now()->format('Y-m');
    }

    public function render()
    {
        return view('livewire.transaction.export');
    }
}
