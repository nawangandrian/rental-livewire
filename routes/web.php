<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Livewire\Items;
use App\Livewire\Customers;
use App\Livewire\Rentals;
use App\Livewire\Dashboard;
use Livewire\Volt\Volt;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->get('/items', Items::class)->name('items.index');
Route::middleware(['auth'])->get('/customers', Customers::class)->name('customers.index');
Route::middleware(['auth'])->get('/rentals', Rentals::class)->name('rentals.index');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
