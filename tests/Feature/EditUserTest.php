<?php

namespace Tests\Feature;

use App\Livewire\EditUser;
use App\Livewire\ListUsers;
use App\Models\Address;
use App\Models\User;
use Livewire\Livewire;

test('edit user form is shown', function () {
    $user = User::factory()->has(Address::factory())->create();

    Livewire::test(EditUser::class, ['user' => $user])
        ->assertStatus(200)
        ->assertSee('Edit User');
});

test('can update user', function () {
    $user = User::factory()->has(Address::factory())->create();

    Livewire::test(ListUsers::class)
        ->assertSee($user->email);

    Livewire::test(EditUser::class, ['user' => $user])
        ->set([
            'form.email' => 'test@example.com',
        ])
        ->call('update')
        ->assertHasNoErrors()
        ->assertDispatched('user-updated')
        ->assertDispatched('notify', content: 'User successfully updated', type: 'success');

    Livewire::test(ListUsers::class)
        ->assertSee('test@example.com');

    $user = User::all()->first();

    expect($user->email)
        ->toBe('test@example.com');
});

test('can update user address', function () {
    $user = User::factory()->has(Address::factory())->create();

    Livewire::test(ListUsers::class)
        ->assertSee($user->email);

    $oldTown = $user->town;

    Livewire::test(EditUser::class, ['user' => $user])
        ->set([
            'form.town' => 'Crazy Town',
        ])
        ->call('update')
        ->assertHasNoErrors()
        ->assertDispatched('user-updated')
        ->assertDispatched('notify', content: 'User successfully updated', type: 'success');

    $user = User::all()->first();

    expect($user->address->town !== $oldTown)
        ->toBeTrue()
        ->and($user->address->town)
        ->toBe('Crazy Town');
});

test('edit user form will show validation error', function () {
    $user = User::factory()->has(Address::factory())->create();

    Livewire::test(EditUser::class, ['user' => $user])
        ->assertStatus(200)
        ->assertSee('Edit User')
        ->set([
            'form.name' => '',
            'form.email' => '',
            'form.addressLine1' => '',
            'form.city' => '',
            'form.postcode' => '',
        ])
        ->call('update')
        ->assertHasErrors([
            'form.name' => 'required',
            'form.email' => 'required',
            'form.addressLine1' => 'required',
            'form.city' => 'required',
            'form.postcode' => 'required',
        ]);
});
