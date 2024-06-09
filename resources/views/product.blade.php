@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-lg-6">
            <div class="product">
                <img src="{{ Vite::asset('public/') . $product->img }}" alt="{{ $product->title }}" class="product__image w-100">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product__main-info">
                <h2 class="product__title">{{ $product->title }}</h2>
                <p class="product__price">{{ $product->price }} руб.</p>
                @auth
                <button class="product__add-to-cart btn p-2 m-1">Добавить в корзину</button>
                <div class="toast error align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            В наличии столько нет
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 mm-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <div class="toast success align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Товар добавлен в корзину
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 mm-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                @else
                <p>Чтобы добавить товар в корзину, пожалуйста, <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>.</p>
                @endauth
            </div>
            <div class="product__characteristic">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Категория</td>
                            <td>{{ $product->product_type }}</td>
                        </tr>
                        <tr>
                            <td>Страна-производитель</td>
                            <td>{{ $product->country }}</td>
                        </tr>
                        <tr>
                            <td>Вкус</td>
                            <td>{{ $product->flavor }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <h3 style="margin-bottom: 50px">Вам так же может понравится</h3>
            <div class="catalog__list">
                @foreach ($similarProducts->take(3) as $similarProduct)
                <div class="catalog__item" style="width: 400px;">
                    <img src="{{ Vite::asset('/public/') . $similarProduct->img }}" alt="{{ $similarProduct->title }}" class="catalog__item-img">
                    <div class="catalog__item-content">
                        <div class="catalog__item-title">{{ $similarProduct->title }}</div>
                        <div class="catalog__item-price"><b>{{ $similarProduct->price }} Руб.</b></div>
                        <div class="catalog__item-rating">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $similarProduct->rating)
                                    <span class="star filled">&#9733;</span>
                                @else
                                    <span class="star">&#9734;</span>
                                @endif
                            @endfor
                        </div>
                        <a href="{{ route('product', ['id' => $similarProduct->id]) }}" class="btn-more">Подробнее</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
<script>
    const pid = {{ $product->id }};
    const button = document.querySelector('.product__add-to-cart');
    button.addEventListener('click', () => {
        let status = 0;
        fetch(`/add-to-cart/${pid}`)
            .then(response => (status = response.status))
            .then(() => {
                if (status > 300) {
                    const errorToast = new bootstrap.Toast(document.querySelector('.toast.error'));
                    errorToast.show();
                } else {
                    const successToast = new bootstrap.Toast(document.querySelector('.toast.success'));
                    successToast.show();
                }
            });
    });
</script>
@endsection

@extends('layouts.footer')
