<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

#[Title('Login')]
class Login extends Component
{
    use Toastable;

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
            $this->success('Welcome! You have successfully logged in');
        }
        $this->addError('email', 'Password atau email salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
