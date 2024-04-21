<?php

namespace Tests\Feature;

use App\Livewire\CreateUser;
use App\Livewire\ListUsers;
use App\Models\User;
use Livewire\Livewire;

test('create user form is shown', function () {
    Livewire::test(CreateUser::class)
        ->assertStatus(200)
        ->assertSee('Create User');
});

test('can create user', function () {
    Livewire::test(CreateUser::class)
        ->set([
            'form.name' => 'John Doe',
            'form.email' => 'john@doe.com',
            'form.addressLine1' => 'Street 1',
            'form.addressLine2' => 'House #1',
            'form.town' => 'Town',
            'form.city' => 'City',
            'form.postcode' => 'Postcode',
        ])
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('user-created')
        ->assertDispatched('notify', content: 'User successfully saved', type: 'success');

    Livewire::test(ListUsers::class)
        ->assertSee('john@doe.com');

    $user = User::all()->first();

    expect($user->email)
        ->toBe('john@doe.com')
        ->and($user->address->city)
        ->toBe('City');
});

test('create user form will show validation error', function () {

    Livewire::test(CreateUser::class)
        ->assertStatus(200)
        ->assertSee('Create User')
        ->call('save')
        ->assertHasErrors([
            'form.name' => 'required',
            'form.email' => 'required',
            'form.addressLine1' => 'required',
            'form.city' => 'required',
            'form.postcode' => 'required',
        ]);
});
