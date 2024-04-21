<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;

    public UserForm $form;

    public function mount(User $user): void
    {
        $this->form->setUser($user);
        $this->user = $user;
    }

    public function update(): void
    {
        $this->form->update();

        $this->dispatch('user-updated');
        $this->dispatch('notify', content: 'User successfully updated', type: 'success');
    }

    public function resetForm(): void
    {
        $this->form->setUser($this->user);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user-form', ['action' => 'update', 'title' => __('Edit User')]);
    }
}
