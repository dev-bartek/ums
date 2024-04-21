<?php

namespace Tests\Feature;

use App\Livewire\ListUsers;
use App\Models\Address;
use App\Models\User;
use Livewire\Livewire;

test('user list is shown', function () {
    User::factory()
        ->has(Address::factory())
        ->count(10)
        ->create();

    Livewire::test(ListUsers::class)
        ->assertStatus(200);
});

test('can see control elements', function () {
    User::factory()
        ->has(Address::factory())
        ->create();

    Livewire::test(ListUsers::class)
        ->assertSee(['Create', 'Edit', 'Delete']);
});

test('can see existing user', function () {
    $user = User::factory()
        ->has(Address::factory())
        ->create();

    Livewire::test(ListUsers::class)
        ->assertSee($user->name)
        ->assertSee($user->email);
});

test('can delete the user', function () {
    $user = User::factory()
        ->has(Address::factory())
        ->create();

    Livewire::test(ListUsers::class)
        ->assertSee($user->name)
        ->call('delete', $user->id)
        ->assertHasNoErrors()
        ->assertDontSee($user->name);
});
