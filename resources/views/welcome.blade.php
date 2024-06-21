<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/media/images/logo.ico') }}">
    <title>CoffeeTeaFusion</title>
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="{{ Vite::asset('/public/media/images/banners/banner3.jpg')}}" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ Vite::asset('/public/media/images/banners/banner1.jpg')}}" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ Vite::asset('/public/media/images/banners/banner2.jpg')}}" class="d-block w-100" alt="...">
                </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


        <section class="about">
            <h1 style="text-align:center; margin-top:80px">Из чего состоит CoffeeTeaFusion</h1>
            <div class="cards-container">
                <div class="card">
                  <img src="{{ Vite::asset('/public/media/images/cart-about/countryes.jpg')}}" alt="World Icon" class="card-icon">
                  <div class="card-title">6 стран</div>
                  <div class="card-text">Сегодня вы можете посетить наши галереи в России, Бельгии, Франции, Америки, Латвии, на Кипре</div>
                </div>

                <div class="card">
                  <img src="{{ Vite::asset('/public/media/images/cart-about/tea.jpg')}}" alt="Tea Cup Icon" class="card-icon">
                  <div class="card-title">300 позиций чая и кофе</div>
                  <div class="card-text">Мы постоянно развиваем ассортимент, предлагая уникальные вкусы</div>
                </div>

                <div class="card">
                  <img src="{{ Vite::asset('/public/media/images/cart-about/tel.jpg')}}" alt="Shopping App Icon" class="card-icon">
                  <div class="card-title">Интернет-магазин и мобильное приложение</div>
                  <div class="card-text">Кантата в вашем смартфоне: заказ в несколько кликов, отзывы на продукцию, самые интересные новости из мира</div>
                </div>
            </div>

                <h1 style="text-align:center; margin-top:80px">Наши поставщики</h1>
                <div class="suppliers-container">

                    <div class="supplier-card">
                        <img src="{{ Vite::asset('/public/media/images/otz/Soma.jpg')}}" alt="Supplier 1" class="supplier-image">
                        <div class="supplier-name">Soma</div>
                        <div class="supplier-description">Высоко в горах Владикавказа Родион и Светлана вручную собирают натуральные травы и мед, из которых в дальнейшем и создаются мед-бальзамы и сиропы Soma.</div>
                    </div>

                    <div class="supplier-card">
                        <img src="{{ Vite::asset('/public/media/images/otz/Coffeeroots.jpg')}}" alt="Supplier 2" class="supplier-image">
                        <div class="supplier-name">Coffeeroots</div>
                        <div class="supplier-description">Компания Coffeeroots является одним из старейших партнеров Кантаты. Именно они поставляют и обжаривают весь кофе, который вы можете найти в наших галереях.</div>
                    </div>

                    <div class="supplier-card">
                        <img src="{{ Vite::asset('/public/media/images/otz/Changsha.jpg')}}" alt="Supplier 3" class="supplier-image">
                        <div class="supplier-name">Changsha Tea Good Company</div>
                        <div class="supplier-description">Всем известно, что Китай является одним из крупнейших производителей чая. Уже несколько лет мы сотрудничаем с Changsha Tea Good Company, которые поставляют нам классические сорта чая из Китая.</div>
                    </div>
                </div>

                <div class="banner-about">
                    <div class="banner-about-content">
                      <h1>Лучшее для вас</h1>
                      <h3>Высокое качество нашего ассортимента и уровень сервиса подтверждают премии и награды</h3>
                      <div class="awards">
                        <img src="{{ Vite::asset('/public/media/images/banners/awards1.jpg')}}" alt="Award 1">
                        <img src="{{ Vite::asset('/public/media/images/banners/awards2.jpg')}}" alt="Award 2">
                        <img src="{{ Vite::asset('/public/media/images/banners/awards3.png')}}" alt="Award 3">
                      </div>
                    </div>
                  </div>


        </section>
    @endsection
    @extends('layouts.footer')
</body>

</html>
