<?php

namespace Monzer\FilamentEmailVerificationAlert\Livewire;

use Filament\Notifications\Notification;
use Livewire\Component;

class EmailVerificationAlert extends Component
{
    public string $color;
    public bool $persistClosedState;
    public bool $closable;
    public bool $showPlaceholder;

    public function __construct()
    {
        $this->color = app()->bound('email-verification-alert.color')
            ? app()->make('email-verification-alert.color')
            : 'yellow';

        $this->persistClosedState = app()->bound('email-verification-alert.persistClosedState')
            ? app()->make('email-verification-alert.persistClosedState')
            : false;

        $this->closable = app()->bound('email-verification-alert.closable')
            ? app()->make('email-verification-alert.closable')
            : true;

        $this->showPlaceholder = app()->bound('email-verification-alert.showPlaceholder')
            ? app()->make('email-verification-alert.showPlaceholder')
            : true;
    }

    public function resendVerification()
    {
        try {
            $user = auth()->user();

            // Check if there's a custom callback
            $callback = app()->bound('email-verification-alert.verifyUsing')
                ? app()->make('email-verification-alert.verifyUsing')
                : null;

            if ($callback) {
                $callback($user);
            } else {
                $user->sendEmailVerificationNotification();

                Notification::make()
                    ->title(trans('filament-email-verification-alert::messages.verification.success'))
                    ->success()
                    ->send();
            }

        } catch (\Exception $e) {
            Notification::make()
                ->title(trans('filament-email-verification-alert::messages.verification.failed'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function hideAlert(): void
    {
        if ($this->persistClosedState) {
            session()->put('hide_email_verification_alert', true);
        }
    }

    public function render()
    {
        return view('filament-email-verification-alert::livewire.email-verification-alert');
    }

    public function placeholder()
    {
        if ($this->showPlaceholder)
            return view('filament-email-verification-alert::livewire.email-verification-alert-placeholder');

        return "<div></div>";
    }
}
