<div class="header-top">
    <div class="contact-info">
        <span href="#">г. Ульяновск.</span>
        <b><a href="-#">+7 999 999 99 99</a></b>
    </div>
</div>
<nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('glav') }}">
                <img src="{{ Vite::asset('public/media/images/logo.png') }}" style="height: 60px; width: auto; margin-right: 10px;">
                CoffeeTeaFusion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2  justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" aria-current="page" href="{{ route('about') }}">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('akadem') ? 'active' : '' }}" href="{{ route('akadem') }}">Академия CoffeeTeaFusion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('where') ? 'active' : '' }}" href="{{ route('where') }}">Где нас найти?</a>
                    </li>
                </ul>
                <div class="user-actions d-flex justify-content-center">
                    @guest
                        <div class="d-flex gap-1">
                            <a href="{{ route('register') }}" class="nav-link {{ Request::is('register') ? 'active' : '' }}">Регистрация</a>
                            <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Войти</a>
                        </div>
                    @endguest

                    @auth
                        <div class="d-flex gap-2">
                            <a href="{{ route('user') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }}">👤</a>
                            <a href="{{ route('cart') }}" class="nav-link {{ Request::is('cart') ? 'active' : '' }}">🛒</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</nav>

@auth
    @if (Auth::user()->is_admin === 1)
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('product-create') ? 'active' : '' }}" aria-current="page"
                            href="/product-create"> Создать товар </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('products') ? 'active' : '' }}" aria-current="page"
                            href="/products"> Управление </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('category-create') ? 'active' : '' }}" aria-current="page"
                            href="/category-create"> Создать категорий </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" aria-current="page"
                            href="/categories"> Управление категориями </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('orders') ? 'active' : '' }}" aria-current="page" href="/orders">
                            Управление заказами </a>
                    </li>

                </ul>
            </div>
        </nav>
    @endif
@endauth
