<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Form;

class CustomerForm extends Form
{
    public $name;
    public $contact;
    public $desc;
    public ?Customer $customer;

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
        $this->name = $customer->name;
        $this->contact = $customer->contact;
        $this->desc = $customer->desc;
    }

    public function store()
    {
        $data = $this->validate([
            'name' => 'required|max:255',
            'contact' => 'required',
            'desc' => 'nullable|string',
        ]);
        $customer = Customer::create($data);
        $this->reset();
        return $customer;
    }
    public function update(): void
    {
        $data = $this->validate([
            'name' => 'required|max:255',
            'contact' => 'required',
            'desc' => 'nullable|string',
        ]);
        $this->customer->update($data);
        $this->reset();
    }
}
