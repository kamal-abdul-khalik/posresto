<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Support\Str;
use App\Models\CategoryMenu;

class CategoryForm extends Form
{
    public $name;
    public ?CategoryMenu $category;

    public function setCategory(CategoryMenu $category): void
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    public function store(): CategoryMenu
    {
        $data = $this->validate([
            'name' => 'required|unique:category_menus,name,NULL,id',
        ]);
        $data['slug'] = Str::slug($this->name);
        $category = CategoryMenu::create($data);
        $this->reset();
        return $category;
    }
    public function update(): void
    {
        $data = $this->validate([
            'name' => 'required|unique:category_menus,name,' . $this->category->id . ',id',
        ]);
        $this->category->update($data);
        $this->reset();
    }
}
