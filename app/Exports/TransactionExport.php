<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    public $month;
    public $year;
    public function __construct($date)
    {
        [$this->year, $this->month] = explode('-', $date);
    }
    public function view(): View
    {
        $transactions = Transaction::query()
            ->with('customer')
            ->done()
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();
        return view('export.transaction', [
            'transactions' => $transactions,
        ]);
    }
}
