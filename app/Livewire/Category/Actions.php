<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\CategoryForm;
use App\Models\CategoryMenu;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class Actions extends Component
{
    use Toastable;

    public $showModalCategory = false;
    public CategoryForm $form;


    #[On('createCategory')]
    public function createCategory(): void
    {
        $this->showModalCategory = true;
    }

    public function save()
    {
        if (isset($this->form->category)) {
            $this->form->update();
            $this->success('Category update successfully');
        } else {
            $this->form->store();
            $this->success('Category saved successfully');
        }
        $this->closeModal();
        $this->dispatch('reload');
    }

    #[On('editCategory')]
    public function editCategory(CategoryMenu $category): void
    {
        $this->form->setCategory($category);
        $this->showModalCategory = true;
    }

    #[On('deleteCategory')]
    public function deleteCategory(CategoryMenu $category): void
    {
        $category->delete();
        $this->dispatch('reload');
        $this->success('Category deleted successfully');
    }

    public function closeModal(): void
    {
        $this->showModalCategory = false;
        $this->form->reset();
    }
    public function render()
    {
        $categories = CategoryMenu::get();
        return view('livewire.category.actions', [
            'categories' => $categories,
        ]);
    }
}
