@props(['user'])
<button
    type="button"
    wire:click="delete({{$user->getKey()}})"
    wire:confirm="Are you sure you want to delete user: {{ $user->name }}?"
    class="text-red-600 text-sm rounded-md border border-red-600 hover:text-white hover:bg-red-600 focus:outline-none focus:shadow-outline px-4 py-1.5"
>
    Delete
</button>
