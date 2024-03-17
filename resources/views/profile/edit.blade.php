<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="font-bold text-2xl my-2">2 FA authentication</div>
                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="mb-4 font-medium text-sm">
                            Please finish configuring two factor authentication below.
                        </div>
                    @endif
                    @if (session('status') == 'two-factor-authentication-disabled')
                        <div class="mb-4 font-medium text-sm">
                            Two factor authentication disabled
                        </div>
                    @endif
                    @if (session('status') == 'two-factor-authentication-confirmed')
                        <div class="mb-4 font-medium text-sm">
                            Two factor authentication confirmed and enabled successfully.
                        </div>
                    @endif
                    {{-- Show QR code here --}}
                    @if (auth()->user()->two_factor_secret)
                        <div class="py-5">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                    @endif
                    {{-- Button enabled 2 FA --}}
                    @if (!auth()->user()->two_factor_secret)
                        <form method="POST" action="/user/two-factor-authentication">
                            @csrf
                            <x-primary-button class="my-2">
                                {{ __('Enabled') }}
                            </x-primary-button>
                        </form>
                    @else
                        {{-- Button diabled --}}
                        <form method="POST" action="/user/two-factor-authentication">
                            @csrf
                            @method('delete')
                            <x-danger-button class="my-2">
                                {{ __('Disabled') }}
                            </x-danger-button>

                        </form>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
