<?php

use App\Livewire\ListUsers;
use Illuminate\Support\Facades\Route;

Route::get('/', ListUsers::class);
