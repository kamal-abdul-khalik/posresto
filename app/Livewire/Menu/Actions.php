<?php

namespace App\Livewire\Menu;

use App\Livewire\Forms\MenuForm;
use App\Models\CategoryMenu;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;
use Masmerise\Toaster\Toaster;

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
            $this->success('Menu update successfully');
        } else {
            $this->form->store();
            $this->success('Menu saved successfully');
        }
        $this->closeMenu();
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
        $menu->image ? Storage::disk('public')->delete($menu->image) : false;
        $this->dispatch('reload');
        $this->success('Menu deleted successfully');
    }

    public function closeMenu(): void
    {
        $this->showModalForm = false;
        $this->form->reset();
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
