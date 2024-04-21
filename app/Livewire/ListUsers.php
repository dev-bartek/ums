<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ListUsers extends Component
{
    use WithoutUrlPagination,
        WithPagination;

    protected $listeners = [
        'user-created' => '$refresh',
        'user-updated' => '$refresh',
    ];

    public function delete(string $userId): void
    {
        $user = User::findOrFail($userId);

        $user->delete();

        $this->resetPage();

        $this->dispatch('notify', content: 'User successfully deleted', type: 'success');
    }

    public function render()
    {
        return view('livewire.list-users', [
            'users' => User::with('address')
                ->orderBy('created_at', 'desc')
                ->paginate(5),
        ]);
    }
}
