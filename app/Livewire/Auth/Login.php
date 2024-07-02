<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email|max:255')]
    public string $email;

    #[Validate('required')]
    public string $password;

    public function login(): void
    {
        $valid = $this->validate();
        if (Auth::attempt($valid)) {
            $this->redirect(route('home', true), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
