<?php

namespace App\Livewire\Menu;

use App\Livewire\Forms\MenuForm;
use App\Models\CategoryMenu;
use App\Models\Menu;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;

class Actions extends Component
{
    use WithFileUploads;
    use Toastable;

    public $showModalForm = false;
    public $image;
    public MenuForm $form;


    #[On('createMenu')]
    public function createMenu(): void
    {
        $this->showModalForm = true;
    }

    public function save()
    {

        if ($this->image) {
            $this->form->image = $this->image->hashName('menu');
            $this->image->store('menu');
        }

        if (isset($this->form->menu)) {
            $this->form->update();
            $this->success('Menu berhasil diupdate.');
        } else {
            $this->form->store();
            $this->success('Menu berhasil disimpan.');
        }
        $this->closeModal();
        $this->dispatch('reload');
    }

    #[On('editMenu')]
    public function editMenu(Menu $menu): void
    {
        $this->form->setMenu($menu);
        $this->showModalForm = true;
    }

    #[On('deleteMenu')]
    public function deleteMenu(Menu $menu): void
    {
        $menu->delete();
        $this->dispatch('reload');
        $this->warning('Menu masuk ke tempat sampah.');
    }

    #[On('item-selected')]
    public function handleItemSelected($data)
    {
        if ($data['wireModel'] === 'form.category_menu_id') {
            $this->form->category_menu_id = $data['id'];
        }
    }

    #[On('category-saved')]
    public function handleCategorySaved($data)
    {
        $this->dispatch('item-saved', ['id' => $data['categoryId']]);
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
        $categories = CategoryMenu::get();
        return view('livewire.menu.actions', [
            'categories' => $categories,
        ]);
    }
}
