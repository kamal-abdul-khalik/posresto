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

    #[On('show-customer-form')]
    public function showCustomerForm(): void
    {
        $this->showModalForm = true;
    }

    #[On('createCustomer')]
    public function createCustomer(): void
    {
        $this->showModalForm = true;
    }

    public function save()
    {
        try {
            if (isset($this->form->customer)) {
                $this->form->update();
                $customer = $this->form->customer;
                $this->success('Customer update successfully');
            } else {
                $customer = $this->form->store();
                $this->success('Customer saved successfully');
            }
            
            $this->closeModal();
            if ($customer) {
                $this->dispatch('customer-saved', [
                    'customerId' => $customer->id,
                    'customerName' => $customer->name,
                    'customerContact' => $customer->contact
                ]);
            }
            $this->dispatch('reload');
        } catch (\Exception $e) {
            $this->error('Failed to save customer: ' . $e->getMessage());
        }
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
        $this->form->resetValidation();
        $this->image = null;
    }
    public function render()
    {
        return view('livewire.customer.actions');
    }
}
