# Filament Email Verification Alert

A Filament plugin that adds an email verification alert to your admin panel. This plugin integrates seamlessly with Filament's design and provides an easy way to alert users about email verification.

## Features
- 🔔 Email verification alert for unverified users
- 🎨 Multiple color themes (yellow, blue, red)
- 🌐 RTL support
- ⚡ Lazy loading support
- 💪 Customizable verification handling

## Installation

You can install the package via composer:

```bash
composer require monzer/filament-email-verification-alert
```

## Basic Usage

In your `FilamentServiceProvider` or any service provider where you configure your panel, add:

```php
use Monzer\FilamentEmailVerificationAlert\EmailVerificationAlertPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            EmailVerificationAlertPlugin::make(),
        ]);
}
```

## Available Methods

### Basic Configuration

```php
EmailVerificationAlertPlugin::make()
```
Creates a new instance of the plugin.

### Color Customization

```php
->color('blue') // 'yellow', 'blue', or 'red'
```
Sets the color theme for the alert. Defaults to 'yellow'.

### Verification Handler

```php
->verifyUsing(function($user) {
    // Custom verification logic
    $user->notify(new CustomVerificationNotification());
})
```
Customizes how verification emails are sent.

### Position Customization

```php
->renderHookName('panels::body.start')
```
Changes where the alert appears. Default is 'panels::topbar.start'.

Available positions:
- `panels::topbar.start`
- `panels::topbar.end`
- `panels::body.start`
- `panels::body.end`
- `panels::footer.before`
- `panels::footer.after`

### Scoping

```php
->renderHookScopes(['list', 'form'])
```
Limits where the alert appears. By default, shows on all pages.

Available scopes:
- `'list'` - Resource list pages
- `'form'` - Resource form pages
- `'table'` - Table pages
- `'widget'` - Widget pages

### Lazy Loading

```php
->lazy(false) // Default is true
```
Controls whether the alert is lazy loaded.

### Complete Example

```php
use Monzer\FilamentEmailVerificationAlert\EmailVerificationAlertPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            EmailVerificationAlertPlugin::make()
                ->color('blue')
                ->renderHookName('panels::body.start')
                ->renderHookScopes(['list', 'form'])
                ->lazy(false)
                ->verifyUsing(function($user) {
                    // Custom verification logic
                    $user->notify(new CustomVerificationNotification());
                }),
        ]);
}
```

### Method Chaining

All methods return the plugin instance, allowing for method chaining:

```php
EmailVerificationAlertPlugin::make()
    ->color('blue')
    ->lazy(false)
    ->renderHookName('panels::body.start');
```

### Translations

The package includes English and Arabic translations. You can publish and customize them:

```bash
php artisan vendor:publish --tag="filament-email-verification-alert-translations"
```

Available translation keys:
```php
return [
    'not_verified' => 'Your email address is not verified.',
    'resend_link' => 'Click here to resend verification email',
    'sending' => 'Sending...',
    'close' => 'Close notification',
    'verification' => [
        'success' => 'A new verification link has been sent to your email address.',
        'failed' => 'Failed to send verification email. Please try again.',
    ]
];
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.