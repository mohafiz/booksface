<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <hr>
            <h2>Shipping information</h2>
            <br>
            <div>
                <x-jet-label for="firstName" value="{{ __('First Name') }}" />
                <x-jet-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required />
            </div>

            <div>
                <x-jet-label for="lastName" value="{{ __('Last Name') }}" />
                <x-jet-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required />
            </div>
            
            <div>
                <x-jet-label for="Address" value="{{ __('Address') }}" />
                <x-jet-input id="Address" class="block mt-1 w-full" type="text" name="Address" :value="old('Address')" required />
            </div>

            <div>
                <x-jet-label for="secondAddress" value="{{ __('Second Address (Optional)') }}" />
                <x-jet-input id="secondAddress" class="block mt-1 w-full" type="text" name="secondAddress" :value="old('secondAddress')" />
            </div>

            <div>
                <select name="State" id="State">
                    <option value="1">Khartoum</option>
                    <option value="2">Gezira</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
