<div>
    @auth
        @unless(auth()->user()->hasVerifiedEmail() || ($persistClosedState && session()->has('hide_email_verification_alert')))
            <div x-data="{ show: true }" x-show="show">
                <div @class([
                    'relative p-4 rtl:border-r-4 ltr:border-l-4',
                    'bg-yellow-50 border-yellow-400' => $color === 'yellow',
                    'bg-blue-50 border-blue-400' => $color === 'blue',
                    'bg-red-50 border-red-400' => $color === 'red',
                ])>
                    <div class="flex items-center justify-between">
                        <div class="flex-shrink-0">
                            <svg @class([
                                'h-5 w-5',
                                'text-yellow-400' => $color === 'yellow',
                                'text-blue-400' => $color === 'blue',
                                'text-red-400' => $color === 'red',
                            ]) xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1 rtl:mr-3 ltr:ml-3">
                            <p @class([
                                'text-sm',
                                'text-yellow-700' => $color === 'yellow',
                                'text-blue-700' => $color === 'blue',
                                'text-red-700' => $color === 'red',
                            ])>
                                {{ trans('filament-email-verification-alert::messages.not_verified') }}
                                <button
                                    wire:click="resendVerification"
                                    wire:loading.attr="disabled"
                                    @class([
                                        'rtl:mr-2 ltr:ml-2 underline font-medium transition-colors duration-200',
                                        'text-yellow-700 hover:text-yellow-600' => $color === 'yellow',
                                        'text-blue-700 hover:text-blue-600' => $color === 'blue',
                                        'text-red-700 hover:text-red-600' => $color === 'red',
                                    ])
                                >
                                    <span wire:loading.remove>{{ trans('filament-email-verification-alert::messages.resend_link') }}</span>
                                    <span wire:loading>{{ trans('filament-email-verification-alert::messages.sending') }}</span>
                                </button>
                            </p>
                        </div>
                        @if($closable)
                            <button @click="show = false; $wire.hideAlert()" @class([
                            'rtl:mr-3 ltr:ml-3',
                            'text-yellow-700 hover:text-yellow-600' => $color === 'yellow',
                            'text-blue-700 hover:text-blue-600' => $color === 'blue',
                            'text-red-700 hover:text-red-600' => $color === 'red',
                        ])>
                                <span class="sr-only">{{ trans('filament-email-verification-alert::messages.close') }}</span>
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endunless
    @endauth
</div>
