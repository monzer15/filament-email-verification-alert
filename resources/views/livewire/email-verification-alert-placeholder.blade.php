@php
    $color = app()->bound('email-verification-alert.color')
        ? app()->make('email-verification-alert.color')
        : 'yellow';

    $persistClosedState = app()->make('email-verification-alert.persistClosedState');

@endphp

<div>
    @unless(session()->get('hide_email_verification_alert'))
        <div @class([
    'p-4 animate-pulse rtl:border-r-4 ltr:border-l-4',
    'bg-yellow-50/50 border-yellow-400/50' => $color === 'yellow',
    'bg-blue-50/50 border-blue-400/50' => $color === 'blue',
    'bg-red-50/50 border-red-400/50' => $color === 'red',
])>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div @class([
                'h-5 w-5 rounded-full',
                'bg-yellow-400/50' => $color === 'yellow',
                'bg-blue-400/50' => $color === 'blue',
                'bg-red-400/50' => $color === 'red',
            ])></div>
                </div>
                <div class="rtl:mr-3 ltr:ml-3 flex-1">
                    <div class="flex items-center gap-2">
                        <div @class([
                    'h-4 w-48 rounded',
                    'bg-yellow-200/50' => $color === 'yellow',
                    'bg-blue-200/50' => $color === 'blue',
                    'bg-red-200/50' => $color === 'red',
                ])></div>
                        <div @class([
                    'h-4 w-40 rounded',
                    'bg-yellow-200/50' => $color === 'yellow',
                    'bg-blue-200/50' => $color === 'blue',
                    'bg-red-200/50' => $color === 'red',
                ])></div>
                    </div>
                </div>
                <div class="rtl:mr-3 ltr:ml-3">
                    <div @class([
                'h-5 w-5 rounded',
                'bg-yellow-200/50' => $color === 'yellow',
                'bg-blue-200/50' => $color === 'blue',
                'bg-red-200/50' => $color === 'red',
            ])></div>
                </div>
            </div>
        </div>
    @endif
</div>

