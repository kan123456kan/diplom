<x-guest-layout>
    <div class="container-register">
        <div class="welcome-section">
            <h1>Добро пожаловать</h1>
            <p>Укажите свои данные для регистрации. Если зарегитрированы, можете нажать на кнопку ниже!</p>
            <button onclick="location.href='{{ route('login') }}'" class="button-welcome">Войти</button>
        </div>

        <div class="register-section" id="register-form">
            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf
                <h3 style="text-align: center">Регистрация</h3>
                <!-- Name -->
                <div class="mt-2 register-group">
                    <x-input-label for="name" :value="__('Имя')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Surname -->
                <div class="mt-2 register-group">
                    <x-input-label for="surname" :value="__('Фамилия')" />
                    <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                        :value="old('surname')" required autofocus autocomplete="surname" />
                    <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                </div>

                <!-- Patronymic -->
                <div class="mt-2 register-group">
                    <x-input-label for="patronymic" :value="__('Отчество')" />
                    <x-text-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic"
                        :value="old('patronymic')" required autofocus autocomplete="patronymic" />
                    <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
                </div>

                <!-- Login -->
                <div class="mt-2 register-group">
                    <x-input-label for="login" :value="__('Логин')" />
                    <x-text-input id="login" class="block mt-1 w-full" type="text" name="login"
                        :value="old('login')" required autofocus autocomplete="login" />
                    <x-input-error :messages="$errors->get('login')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-2 register-group">
                    <x-input-label for="email" :value="__('Электронная почта')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-2 register-group">
                    <x-input-label for="password" :value="__('Пароль')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-2 register-group">
                    <x-input-label for="password_confirmation" :value="__('Повторите пароль')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Checkbox -->

                <div class="mt-2 register-group">
                    <input id="rules_confirmation" class="block mt-1 w-full" type="checkbox" name="rules_confirmation"
                        required />
                    <label class="custom-checkbox" for="rules_confirmation" style="border-color: #f98a12;"></label>
                    <x-input-label for="rules_confirmation" :value="__('Согласен с правилами регистрации')" />
                    <a href="{{ asset('rules.rtf') }}" download style="color: #f98a12">&#x2193;</a>
                </div>

                <x-primary-button class="ml-4 button-register">
                    {{ __('Зарегистрироваться') }}
                </x-primary-button>
        </div>
        </form>
    </div>
</x-guest-layout>
