<?php

namespace App\Livewire\Forms;

use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class MenuForm extends Form
{
    public $name;
    public $price;
    public $desc;
    public $category_menu_id;
    public $image;
    public ?Menu $menu;

    public function setMenu(Menu $menu): void
    {
        $this->menu = $menu;
        $this->name = $menu->name;
        $this->price = $menu->price;
        $this->desc = $menu->desc;
        $this->category_menu_id = $menu->category_menu_id;
    }

    public function store(): void
    {
        $data = $this->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'desc' => 'nullable|string',
            'category_menu_id' => 'required',
        ]);
        if ($this->image) {
            $data['image'] = $this->image;
        }
        Menu::create($data);
        $this->reset();
    }
    public function update(): void
    {
        $data = $this->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'desc' => 'nullable|string',
            'category_menu_id' => 'required',
        ]);
        if ($this->image) {
            $imageExist = $this->menu->image ? Storage::disk('public')->exists($this->menu->image) : false;
            if ($imageExist) {
                Storage::disk('public')->delete($this->menu->image);
            }
            $data['image'] = $this->image;
        }
        $this->menu->update($data);
        $this->reset();
    }
}
