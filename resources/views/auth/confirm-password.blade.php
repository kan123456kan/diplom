<x-guest-layout>
    <div class="container-register">
        <div class="welcome-section">
            <h1>Подтверждение пароля</h1>
            <p>Это защищенная область приложения. Пожалуйста, подтвердите свой пароль, прежде чем продолжить.</p>
        </div>

        <div class="register-section" id="register-form">
            <form method="POST" action="{{ route('password.confirm') }}" class="form">
                @csrf
                <h3 style="text-align: center">Подтверждение пароля</h3>

                <!-- Password -->
                <div class="mt-2 register-group">
                    <x-input-label for="password" :value="__('Пароль')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button class="button-register">
                        {{ __('Подтвердить') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

