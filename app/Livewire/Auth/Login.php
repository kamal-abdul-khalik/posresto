<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Login')]
class Login extends Component
{
    #[Validate('required|email|max:255')]
    public string $email;

    #[Validate('required')]
    public string $password;

    public function login(): void
    {
        $valid = $this->validate();
        if (auth()->attempt($valid)) {
            request()->session()->regenerate();
            $this->redirectIntended(route('home'), true);
        }
        $this->addError('email', 'Password atau email salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
