@extends('layouts.app')
@section('content')
    <style>
        .profile-info {
            display: flex;
            padding: 20px;
            align-items: center;
        }

        .profile-info img {
            width: 30px;
            margin-right: 10px;
        }

        .profile-name {
            font-size: 20px;
        }

        .user-orders {
            margin-top: 20px;
        }

        .order {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
        }

        .order-number {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .order-status {
            font-weight: bold;
        }

        .order-product {
            margin-bottom: 5px;
        }

        .order-total {
            margin-top: 10px;
            font-weight: bold;
        }

        .order-actions {
            margin-top: 10px;
        }

        .user-logout {
            margin-top: 20px;
        }

        .user-logout__button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .user-logout__button:hover {
            background-color: #c82333;
        }

        .delete-account-section {
            margin-top: 30px;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .delete-account-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .delete-account-description {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .mt-6 input {
            border: 1px solid #f98a12;
            box-shadow: none !important;
        }

        .mt-6 input:focus {
            border: 1px solid #f98a12;
            box-shadow: none !important;
        }

        .list-inside {
            list-style-type: none;
        }

        dl,
        ol,
        ul {
         margin-top: 0 !important;
         margin-bottom: 0 !important;
        }

        ol,
        ul {
         padding-left: 0 !important;
        }

        .alert{
            width: 30%;
        }

        .list-inside li{
            padding: 10px
        }
    </style>

    <div class="user">
        @if (count($orders))
            <div class="profile-info">
                <img src="{{ Vite::asset('/public/media/images/register-login/profile.png') }}" alt="profile image">
                @foreach ($users as $user)
                    <div class="profile-name">
                        Ваши заказы, {{ $user->login }}:
                    </div>
                @endforeach
            </div>

            <div class="user-orders orders">
                @foreach ($orders as $order)
                    <div class="order">
                        <div class="order-number">
                            <code>{{ $order->number }}</code>
                            <div class="order-status">
                                {{ $order->status }}
                            </div>
                            @if ($order->status == 'Новый')
                                <form action="/order-delete/{{ $order->number }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Удалить заказ">
                                </form>
                            @endif
                        </div>

                        <div class="order-products">
                            Товары в заказе:
                            @foreach ($order->products as $product)
                                <div class="order-product">
                                    {{ $product->title }} x{{ $product->qty }}: {{ $product->price * $product->qty }} руб.
                                </div>
                            @endforeach
                            Всего товаров: {{ $order->totalQty }} шт.
                        </div>

                        <hr>
                        <div class="order-total">К оплате {{ $order->totalPrice }} руб.</div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-center"> Здесь будут отображаться заказы</h3>
        @endif
        <form action="{{ route('logout') }}" method="post" class="user-logout">
            @csrf
            <button type="submit" class="user-logout__button"> Выйти </button>
        </form>
    </div>

    <section class="delete-account-section">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Удалить аккаунт') }}
            </h3>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Как только ваша учетная запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Пожалуйста, введите свой пароль, чтобы подтвердить, что вы хотите удалить свою учетную запись безвозвратно.') }}
            </p>

            <div class="mt-6">

                <input id="password" name="password" type="password" class="block w-3/4 form-group"
                    placeholder="{{ __('Пароль') }}" />

                @if ($errors->userDeletion->any())
                        <div class="alert alert-danger p-0">
                            <ul class="list-inside list-disc">
                                @foreach ($errors->userDeletion->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end">

                <x-danger-button type="submit" class="ml-3 user-logout__button">
                    {{ __('Удалить аккаунт') }}
                </x-danger-button>
            </div>
        </form>
    </section>

@endsection
@extends('layouts.footer')
