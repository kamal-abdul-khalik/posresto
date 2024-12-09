<?php

namespace App\Livewire\Forms;

use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionForm extends Form
{
    public $invoice;
    public $customer_id;
    public $items;
    public $total;
    public $desc;
    public $is_done = false;
    public ?Transaction $transaction;

    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->invoice = $transaction->invoice;
        $this->customer_id = $transaction->customer_id;
        $this->items = $transaction->items;
        $this->total = $transaction->total;
        $this->desc = $transaction->desc;
        $this->is_done = $transaction->is_done;
    }
    public function store()
    {
        $data = $this->validate([
            'customer_id' => 'required',
            'items' => 'required',
            'total' => 'required',
            'desc' => 'required',
        ]);

        $data['invoice'] = 'INV-' . now()->format('ymdHis');
        $transaction = Transaction::create($data);
        $this->reset();
        return $transaction;
    }
    public function update()
    {
        $data = $this->validate([
            'customer_id' => 'required',
            'items' => 'required',
            'total' => 'required',
            'desc' => 'required',
        ]);

        $this->transaction->update($data);
        $this->reset();
    }
}
