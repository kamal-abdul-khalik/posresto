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
        $this->validate(['month' => 'required']);
        return Excel::download(new TransactionExport($this->month), "laporan-transaksi-{$this->month}.xlsx");
    }
    public function render()
    {
        return view('livewire.transaction.export');
    }
}
