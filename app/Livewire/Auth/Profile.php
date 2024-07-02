<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Profile")]
class Profile extends Component
{
    public string $name;

    public string $email;

    public string $password;

    public User $user;

    public function rules()
    {
        return [
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user),
            ],
            'name' => 'required|min:3|max:255|string',
            'password' => 'nullable|min:8|max:255',
        ];
    }

    public function save(): void
    {
        $data = $this->validate();
        if (isset($this->password)) {
            $data['password'] =  Hash::make($this->password);
        } else {
            unset($data['password']);
        }
        $this->user->update($data);
        $this->reset();
        $this->redirect(route('profile'), true);
    }

    public function mount(): void
    {
        $user = auth()->user();
        $this->user = User::find(auth()->id());
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function render()
    {
        return view('livewire.auth.profile');
    }
}
