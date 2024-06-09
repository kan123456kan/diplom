    <x-guest-layout>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="container-register">
            <div class="welcome-section">
                <h1>Добро пожаловать</h1>
                <p>Если не зарегистрированы, можете нажать на кнопку ниже!</p>
                <button onclick="location.href='{{ route('register') }}'" class="button-welcome">Зарегистрироваться</button>
            </div>

            <div class="register-section" id="register-form">
                <form method="POST" action="{{ route('login') }}" class="form">
                    @csrf
                    <h3 style="text-align: center">Вход</h3>

                    <!-- Login -->
                    <div class="mt-2 register-group">
                        <x-input-label for="login" :value="__('Логин')" />
                        <x-text-input id="login" class="block mt-1 w-full" type="text" name="login"
                            :value="old('login')" required autofocus autocomplete="login" />
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-2 register-group">
                        <x-input-label for="password" :value="__('Пароль')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->

                    <div class="mt-2 register-group">
                        <input id="rules_confirmation" class="block mt-1 w-full" type="checkbox" name="rules_confirmation" />
                        <label class="custom-checkbox" for="rules_confirmation" style="border-color: #f98a12;"></label>
                        <x-input-label for="rules_confirmation" :value="__('Запомнить меня')" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a style="color:black"
                                href="{{ route('password.request') }}">
                                {{ __('Забыли пароль?') }}
                            </a>
                        @endif

                        <x-primary-button class="ml-3 button-register">
                            {{ __('Войти') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-guest-layout>
