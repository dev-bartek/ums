<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateUser extends Component
{
    public UserForm $form;

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->form->store();
        $this->dispatch('user-created');
        $this->dispatch('notify', content: 'User successfully saved', type: 'success');
    }

    public function resetForm(): void
    {
        $this->form->reset();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user-form', ['action' => 'save', 'title' => __('Create User')]);
    }
}
