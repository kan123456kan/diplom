@extends('layouts.app')

@section('content')
    <section class="catalog">
        <h1 style="margin-top: 100px; margin-bottom:50px; text-align:center">Товары</h1>
        <h5>Сортировка по</h5>
        <div class="catalog__sort">
            {{-- рейтинг --}}
            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'rating', 'sort_by_desc' => request()->query('sort_by') == 'rating' && request()->query('sort_by_desc') != 'desc' ? 'desc' : null]) }}"
                class="catalog__sort-item {{ request()->query('sort_by') == 'rating' && request()->query('sort_by_desc') != 'desc' ? 'active' : '' }}">
                Рейтинг
                @if (request()->query('sort_by') == 'rating')
                    @if (request()->query('sort_by_desc') && request()->query('sort_by_desc') == 'desc')
                        &#x25B2;
                    @else
                        &#x25BC;
                    @endif
                @endif
            </a>

            {{-- страна --}}
            <form method="GET" action="{{ route('catalog') }}">
                <select name="country" onchange="this.form.submit()" class="catalog__filter-select">
                    <option value="">Выберите страну</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country }}" {{ request()->query('country') == $country ? 'selected' : '' }}>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>
            </form>

            {{-- цена --}}
            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'price', 'sort_by_desc' => request()->query('sort_by') == 'price' && request()->query('sort_by_desc') != 'desc' ? 'desc' : null]) }}"
                class="catalog__sort-item {{ request()->query('sort_by') == 'price' && request()->query('sort_by_desc') != 'desc' ? 'active' : '' }}">
                Цена
                @if (request()->query('sort_by') == 'price')
                    @if (request()->query('sort_by_desc') && request()->query('sort_by_desc') == 'desc')
                        &#x25B2;
                    @else
                        &#x25BC;
                    @endif
                @endif
            </a>

            <a href="/catalog" class="catalog__sort-item--default">Сбросить</a>

            {{-- название --}}
            <div class="catalog__sort">
            <form method="GET" action="{{ route('catalog') }}" class="catalog__search-form">
                <input type="text" name="search" placeholder="Поиск" class="catalog__search-input"
                    value="{{ request()->query('search') }}" oninput="this.form.submit()">
            </form>
        </div>
        </div>

        <div class="catalog__filter">
            @foreach ($categories as $category)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $category->id]) }}"
                    class="catalog__filter-item {{ request()->query('filter') == $category->id ? 'active' : '' }}">{{ $category->product_type }}</a>
            @endforeach
        </div>

        <div class="catalog__list">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="catalog__item">
                        <img src="{{ Vite::asset('public/') . $product->img }}" alt="{{ $product->title }}"
                            class="catalog__item-img">
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
                @endforeach
            @else
                <h3>Ничего не найдено</h3>
            @endif
        </div>

        @if ($totalProducts > 0)
            <div class="pagination">
                @php
                    $totalPages = ceil($totalProducts / $productsPerPage);
                @endphp

                @if ($currentPage > 1)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}">
                        <<
                @endif

                @for ($i = 1; $i <= $totalPages; $i++)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                        class="{{ $currentPage == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($currentPage < $totalPages)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}">>></a>
                @endif
            </div>
        @endif

    </section>
@endsection
@extends('layouts.footer')
