<?php

namespace Monzer\FilamentEmailVerificationAlert;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Monzer\FilamentEmailVerificationAlert\Livewire\EmailVerificationAlert;

class EmailVerificationAlertServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Livewire::component('email-verification-alert', EmailVerificationAlert::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-email-verification-alert');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-email-verification-alert');
    }
}
