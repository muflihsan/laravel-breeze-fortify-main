<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>

    <div class="py-8 flex justify-center">
        <div class="max-w-2xl mx-auto space-y-8">
            <div class="p-6 bg-white shadow-md rounded-lg">
                <div class="text-2xl font-bold mb-4">2FA Authentication</div>
                @if (session('status') == 'two-factor-authentication-enabled')
                    <div class="mb-4 text-sm text-gray-600">
                        Please finish configuring two-factor authentication below.
                    </div>
                @endif
                @if (session('status') == 'two-factor-authentication-disabled')
                    <div class="mb-4 text-sm text-gray-600">
                        Two-factor authentication disabled.
                    </div>
                @endif
                @if (session('status') == 'two-factor-authentication-confirmed')
                    <div class="mb-4 text-sm text-gray-600">
                        Two-factor authentication confirmed and enabled successfully.
                    </div>
                @endif
                {{-- Show QR code here --}}
                @if (auth()->user()->two_factor_secret)
                    <div class="py-5">
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    </div>
                @endif
                {{-- Button to enable 2FA --}}
                @if (!auth()->user()->two_factor_secret)
                    <form method="POST" action="/user/two-factor-authentication">
                        @csrf
                        <x-primary-button class="my-4">
                            {{ __('Enable') }}
                        </x-primary-button>
                    </form>
                @else
                    {{-- Button to disable 2FA --}}
                    <form method="POST" action="/user/two-factor-authentication">
                        @csrf
                        @method('delete')
                        <x-danger-button class="my-4">
                            {{ __('Disable') }}
                        </x-danger-button>
                    </form>
                @endif
            </div>

            <div class="p-6 bg-white shadow-md rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
