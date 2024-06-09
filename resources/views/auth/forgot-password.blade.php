<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container-register">
        <div class="welcome-section">
            <h1>Сброс пароля</h1>
            <p>Введите ваш адрес электронной почты, чтобы мы могли отправить вам ссылку для сброса пароля.</p>
        </div>

        <div class="register-section" id="register-form">
            <form method="POST" action="{{ route('password.email') }}" class="form">
                @csrf
                <h3 style="text-align: center">Сброс пароля</h3>

                <!-- Email -->
                <div class="mt-2 register-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3 button-register">
                        {{ __('Отправить ссылку для сброса пароля') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
