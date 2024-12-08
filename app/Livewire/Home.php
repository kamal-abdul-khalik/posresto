<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

#[Title('Home')]
class Home extends Component
{
    use WithPagination, WithoutUrlPagination;
    use Toastable;

    #[On('payment-saved')]
    public function handlePaymentSaved($transactionId)
    {
        // The transaction is already updated in the database
        // We just need to refresh the component
        $this->render();
    }

    public function render()
    {
        $today = date('Y-m-d');
        [$year, $month] = explode("-", date('Y-m'));

        $income = Transaction::query()
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year);

        $transactions = Transaction::query()
            ->whereIsDone(false)
            ->with('customer')
            ->latest()
            ->paginate(10);

        // Mengambil semua transaksi
        $getTransactions = Transaction::all();
        // Variabel untuk menyimpan total penjualan
        $totalPenjualan = [];
        // Loop melalui setiap transaksi
        foreach ($getTransactions as $transaction) {
            $items = $transaction->items; // items sudah berupa array
            foreach ($items as $name => $data) {
                if (!isset($totalPenjualan[$name])) {
                    $totalPenjualan[$name] = 0;
                }
                $totalPenjualan[$name] += $data['qty'];
            }
        }

        // Mengkonversi hasil ke bentuk yang diinginkan
        $result = [];
        foreach ($totalPenjualan as $name => $qty) {
            $result[] = [
                'name' => $name,
                'total_penjualan' => $qty
            ];
        }

        // Mengurutkan hasil dari yang terbanyak ke yang terkecil
        usort($result, function ($a, $b) {
            return $b['total_penjualan'] - $a['total_penjualan'];
        });

        // Mengambil hanya 5 data teratas
        $result = array_slice($result, 0, 5);

        return view('livewire.home', [
            'monthly' => $income->done()->get()->sum('total'),
            'today' => $income->whereDate('created_at', $today)->done()->get(),
            'totalSales' => $result,
            'transactions' => $transactions,
        ]);
    }
}
