<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        $this->redirect(route('login'), true);
    }
    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
