<?php

namespace App\Livewire\Customer;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;

class Actions extends Component
{
    use WithFileUploads;
    use Toastable;

    public $showModalForm = false;
    public CustomerForm $form;


    #[On('createCustomer')]
    public function createCustomer(): void
    {
        $this->showModalForm = true;
    }

    public function save()
    {

        if (isset($this->form->customer)) {
            $this->form->update();
            $this->success('Customer update successfully');
        } else {
            $this->form->store();
            $this->success('Customer saved successfully');
        }
        $this->closeModal();
        $this->dispatch('reload');
    }

    #[On('editCustomer')]
    public function editCustomer(Customer $customer): void
    {
        $this->form->setCustomer($customer);
        $this->showModalForm = true;
    }

    #[On('deleteCustomer')]
    public function deleteCustomer(Customer $customer): void
    {
        $customer->delete();
        $this->dispatch('reload');
        $this->success('Customer deleted successfully');
    }

    public function closeModal(): void
    {
        $this->showModalForm = false;
        $this->form->reset();
        $this->image = null;
    }
    public function render()
    {
        return view('livewire.customer.actions');
    }
}
