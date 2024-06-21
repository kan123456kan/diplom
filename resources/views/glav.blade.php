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
                @foreach ($products as $product)
                    <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                        <img src="{{ Vite::asset('public/') . $product->img }}" class="d-block w-100"
                            alt="...">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <h1 style="margin-top: 100px; margin-bottom:50px; text-align:center">Товары</h1>
        <div class="catalog__list">
            @php
                $showLimit = 4;
                $randomProducts = $products->shuffle()->take($showLimit);
            @endphp

            @if (count($products) > 0)
                @php
                    $count = 0;
                @endphp


                @foreach ($randomProducts as $product)
                    @if ($count < $showLimit)
                        <div class="catalog__item">
                            <img src="{{ Vite::asset('public/') . $product->img }}"
                                alt="{{ $product->title }}" class="catalog__item-img">
                            <div class="catalog__item-content">
                                <div class="catalog__item-title">{{ $product->title }}</div>
                                <div class="catalog__item-title">{{ $product->country }}</div>
                                <div class="catalog__item-price"><b>{{ $product->price }} Руб.</b></div>
                                <div class="catalog__item-rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $product->rating)
                                            <span class="star filled">&#9733;</span>
                                        @else
                                            <span class="star">&#9734;</span>
                                        @endif
                                    @endfor
                                </div>
                                <a href="{{ route('product', ['id' => $product->id]) }}" class="btn-more">Подробнее</a>
                            </div>
                        </div>
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
        </div>
        @if (count($products) > $showLimit)
            <div class="view-all">
                <a href="{{ route('catalog') }}">Посмотреть все товары</a>
            </div>
        @endif
    @else
        <h3>Ничего не найдено</h3>
        @endif


        <div>
            <div class="innovation-banner">
                <div class="banner-content">
                    <h1>Академия Инноваций</h1>
                    <p class="subtitle">Откройте потенциал внутри</p>
                    <p>Это возможность изнутри познакомиться с корпоративной культурой и инновациями, а также отлично
                        провести время в живой атмосфере нашего сообщества.</p>
                    <a href="{{ route('akadem') }}"><button class="learn-more-btn">Узнать подробнее</button></a>
                </div>
                <div class="banner-images">
                    <div class="circle-image" style="background-image: url('/media/images/akadem/akadem.jpg');"></div>
                    <div class="circle-image" style="background-image: url('/media/images/akadem/akadem1.jpg');"></div>
                    <div class="circle-image" style="background-image: url('/media/images/akadem/akadem2.png');"></div>
                    <div class="circle-image" style="background-image: url('/media/images/akadem/akadem3.jpg');"></div>
                </div>
            </div>
        </div>
        </div>

        <div class="card-glav-container">
            <div class="card-glav">
                <div class="card-glav-content">
                    <h2>CoffeeTeaFusion</h2>
                    <p>"CoffeeTeaFusion" - это название нового бренда, который предлагает инновационные сочетания кофе и
                        чая. </p>
                    <a href="{{ route('about') }}"><button class="btn">Подробнее</button></a>
                </div>
                <div class="card-glav-image">
                    <img src="/media/images/akadem/card-glav1.png" alt="CoffeeTeaFusion Image">
                </div>
            </div>
            <div class="card-glav">
                <div class="card-glav-content">
                    <h2>Подарки с доставкой</h2>
                    <p>Вы выбираете подарок, а мы доставляем и вручаем его от вашего имени. Стоимость услуги, всего лишь, 0
                        руб!</p>
                    <a href="{{ route('catalog') }}"><button class="btn">Подробнее</button></a>
                </div>
                <div class="card-glav-image">
                    <img src="/media/images/akadem/card-glav2.png" alt="CoffeeTeaFusion Image">
                </div>
            </div>
            <div class="card-glav">
                <div class="card-glav-content">
                    <h2>Сертификаты</h2>
                    <p>Подарочные сертификаты помогут вам не прогадать с выбором, а получателю — насладиться подарком.</p>
                    <a href="{{ route('akadem') }}"><button class="btn">Оставить заявку</button></a>
                </div>
                <div class="card-glav-image">
                    <img src="/media/images/akadem/card-glav3.png" alt="CoffeeTeaFusion Image">
                </div>
            </div>
        </div>
    @endsection
    @extends('layouts.footer')
</body>

</html>
