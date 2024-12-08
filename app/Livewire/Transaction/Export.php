<?php

namespace App\Livewire\Transaction;

use App\Exports\TransactionExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public $startDate;
    public $endDate;

    public function export()
    {
        $this->validate([
            'startDate' => 'required|date|before_or_equal:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        return Excel::download(
            new TransactionExport($this->startDate, $this->endDate),
            'transactions.xlsx'
        );
    }

    public function render()
    {
        return view('livewire.transaction.export');
    }
}
