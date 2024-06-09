@extends('layouts.app')
@section('content')
    <style>
        .table {
            width: 50%;
        }

        th,
        td {
            padding: 2rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .cart__raw img {
            vertical-align: super !important;
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
    <table class="cart__table table container">
        <thead>
            <tr>
                <th>id</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="cart__raw">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->product_type }}</td>

                    <td class="">
                        <a href="/category-edit/{{ $category->id }}" class="btn btn-primary">Редактировать</a>
                        <form action="/category-delete/{{ $category->id }}" method="post" style="margin-top: 20px;">
                            @method('delete')
                            @csrf
                            <input type="submit" value="Удалить" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
