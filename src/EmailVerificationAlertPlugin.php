<?php

namespace Monzer\FilamentEmailVerificationAlert;

use Filament\Contracts\Plugin;
use \Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Support\Facades\Blade;
use Closure;

class EmailVerificationAlertPlugin implements Plugin
{
    use EvaluatesClosures;

    protected string|Closure $render_hook_name = "panels::topbar.start";
    protected array|Closure|null $render_hook_scopes = null;
    protected bool|Closure $is_lazy = true;
    protected ?Closure $verify_using = null;
    private string $color = 'yellow';

    private bool $isClosable = true;
    private bool $shouldPersistClosedState = false;
    private bool $showPlaceholder = true;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'email-verification-alert';
    }

    public function closable(bool $closable = true): static
    {
        $this->isClosable = $closable;
        return $this;
    }

    public function placeholder(bool $show = true): static
    {
        $this->showPlaceholder = $show;
        return $this;
    }

    public function shouldShowPlaceholder(): bool
    {
        return $this->showPlaceholder;
    }
    public function isClosable(): bool
    {
        return $this->isClosable;
    }
    public function renderHookName(string|\Closure $name): static
    {
        $this->render_hook_name = $name;
        return $this;
    }

    public function renderHookScopes(array|Closure|null $scopes): static
    {
        $this->render_hook_scopes = $scopes;
        return $this;
    }

    public function lazy(bool|Closure $lazy = true): static
    {
        $this->is_lazy = $lazy;
        return $this;
    }

    public function getRenderHookName(): string
    {
        return $this->evaluate($this->render_hook_name);
    }

    public function getRenderHookScopes(): array|null
    {
        return $this->evaluate($this->render_hook_scopes);
    }

    public function getIsLazy(): bool
    {
        return $this->evaluate($this->is_lazy);
    }

    public function color(string $color): static
    {
        if (!in_array($color, ['yellow', 'blue', 'red'])) {
            throw new \InvalidArgumentException("Color [{$color}] not found.");
        }
        $this->color = $color;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function persistClosedState(bool $persist = true): static
    {
        $this->shouldPersistClosedState = $persist;
        return $this;
    }

    public function shouldPersistClosedState(): bool
    {
        return $this->shouldPersistClosedState;
    }
    public function verifyUsing(Closure $closure): static
    {
        $this->verify_using = $closure;
        return $this;
    }

    public function register(\Filament\Panel $panel): void
    {
        $lazy = $this->getIsLazy() ? "lazy" : "";
        $panel->renderHook(
            $this->getRenderHookName(),
            fn(): string => Blade::render(
                "<livewire:email-verification-alert $lazy />"
            ), $this->getRenderHookScopes()
        );
    }

    public function boot(\Filament\Panel $panel): void
    {
        if ($this->verify_using) {
            app()->bind('email-verification-alert.verifyUsing', fn() => $this->verify_using);
        }
        app()->bind('email-verification-alert.color', fn() => $this->getColor());
        app()->bind('email-verification-alert.closable', fn() => $this->isClosable());
        app()->bind('email-verification-alert.persistClosedState', fn() => $this->shouldPersistClosedState());
        app()->bind('email-verification-alert.showPlaceholder', fn() => $this->shouldShowPlaceholder());
    }
}
