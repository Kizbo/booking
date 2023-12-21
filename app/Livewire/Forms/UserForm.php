<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    public string $firstname = '';

    public string $lastname = '';

    public string $email = '';

    public string $phone_number = '';

    public function rules(): array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => ['email', 'required', Rule::unique("users", "email")->ignore($this->user?->id)],
            'phone_number' => 'required'
        ];
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
        $this->fill($user);
    }

    public function store(): User
    {
        $this->validate();

        $user = new User;
        $user->password = Hash::make(Str::random(15));
        $user->is_admin = false;

        $user->fill($this->only(['firstname', 'lastname', 'email', 'phone_number']));
        $user->save();

        return $user;
    }

    public function update(): void
    {
        $this->validate();
        $this->user->update($this->only(['firstname', 'lastname', 'email', 'phone_number']));
    }
}
