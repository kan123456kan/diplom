@extends('layouts.app')
@section('content')
    <style>
        .order__filters {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .order__filters__item a {
            text-decoration: none;
            color: #f98a12;
            margin-right: 20px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 17px;
        }

        .order__filters__item a:hover {
            color: #fc9;
        }

        th,
        td {
            padding: 2rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table_button {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 230px;
            margin: auto 0;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #007bff;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-group {
            position: relative;
            display: inline-block;
            vertical-align: middle;
        }

        .btn-group .btn {
            position: relative;
            flex: 1 1 auto;
        }
    </style>
    <div class="order__filters">
        <div class="order__filters__item">
            <a href="?filter=new">Новые</a>
            <a href="?filter=confirmed">Подтвержденные</a>
            <a href="?filter=canceled">Отмененные</a>
            <a href="/orders">Показать все</a>
        </div>
    </div>
    <table class="order__table table container">
        <thead>
            <tr>
                <th>ФИО клиента</th>
                <th>Товары в заказе</th>
                <th>Дата создания</th>
                <th>Итог. сумма</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="order__raw">
                    <td>{{ $order->name }}</td>
                    <td>
                        <div class="order__products">
                            @foreach ($order->products as $product)
                                <div class="order__product">
                                    {{ $product->title }} x{{ $product->qty }}: {{ $product->price * $product->qty }} руб.
                                </div>
                            @endforeach
                            Всего товаров: {{ $order->totalQty }}
                        </div>
                    </td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->totalPrice }}</td>
                    <td>{{ $order->status }}</td>
                    <td class="">
                        <form action="/order-status/confirm/{{ $order->number }}" method="post">
                            @method('patch')
                            @csrf
                            <input type="submit" class="btn btn-success" value="Подтвердить">
                        </form>
                        <form action="{{ route('admin.orders.cancel', $order->number) }}" method="post"
                            style="margin-top: 20px;">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-danger">Отменить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
