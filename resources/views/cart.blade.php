@extends('layouts.app')
@section('content')
    @if (count($cart) > 0)
        <div class="cart-header d-flex justify-content-around">
            <div class="header-item">НАИМЕНОВАНИЕ ТОВАРА</div>
            <div class="header-item">ЦЕНА ЗА ШТ.</div>
            <div class="header-item">КОЛИЧЕСТВО</div>
            <div class="header-item">ЦЕНА</div>
        </div>
        <div class="cart-items">
            @foreach ($cart as $item)
                <div class="cart-item d-flex justify-content-around">
                    <div class="product-info d-flex align-items-center">
                        <img src="{{ Vite::asset('/public/') . $item->img }}" alt="{{ $item->title }}" class="product-image">
                        <div class="product-details">
                            <div class="product-title">{{ $item->title }}</div>
                            <small class="product-description">{{ $item->details ?? 'Детали не указаны' }}</small>
                        </div>
                    </div>
                    <div class="product-price d-flex align-items-center">{{ number_format($item->price, 0) }} ₽</div>
                    <div class="product-quantity d-flex align-items-center">
                        <button class="btn btn-offer decrease" data-cartid="{{ $item->id }}" style="padding: 7px 14px">-</button>
                        <span class="quantity-text">{{ $item->qty }}</span>
                        <button class="btn btn-offer increase" data-cartid="{{ $item->id }}" style="padding: 7px 14px">+</button>
                    </div>
                    <div class="product-total-price d-flex align-items-center">{{ number_format($item->price * $item->qty, 0) }} ₽</div>
                </div>
            @endforeach
        </div>
        <div class="total-summary float-end">
            <div class="order-total">СУММА ЗАКАЗА: {{ number_format($total, 0) }} ₽</div>
            <div class="order-total">ИТОГ: {{ number_format($total, 0) }} ₽</div>
            <a href="{{ route('create-order') }}" class="btn">Оформить Заказ</a>
        </div>
    @else
        <div class="alert" role="alert">
            Корзина пуста.
        </div>
    @endif
<script>
document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', () => {
        const cartId = button.getAttribute('data-cartid');
        fetch(`/changeqty/incr/${cartId}`)
            .then(response => {
                if (response.status >= 300) {
                    const errorToast = new bootstrap.Toast(document.querySelector('.toast.error'));
                    errorToast.show();
                }
            })
            .finally(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            });
    });
});

document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', () => {
        const cartId = button.getAttribute('data-cartid');
        fetch(`/changeqty/decr/${cartId}`)
        .finally(() => window.location.reload());
    });
});
</script>
@endsection
@extends('layouts.footer')
