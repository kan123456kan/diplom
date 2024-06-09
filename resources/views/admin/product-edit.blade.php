@extends('layouts.app')
@section('content')
    <style>
        .mb-3 input {
            border: 1px solid #f98a12;
            box-shadow: none !important;
        }

        .mb-3 input:focus {
            border: 1px solid #f98a12;
            box-shadow: none !important;
        }
    </style>
    <div class="product-edit">
        <form action="/product-update/{{ $product->id }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Количество</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ $product->qty }}">
            </div>
            <div class="mb-3">
                <label for="flavor" class="form-label">Аромат</label>
                <input type="text" class="form-control" id="flavor" name="flavor" value="{{ $product->flavor }}">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="img" name="img" value="{{ $product->img }}"
                    placeholder="Введите название изображения с расширением файла из...">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Страна-производитель</label>
                <input type="text" class="form-control" id="country" name="country" value="{{ $product->country }}">
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Рейтинг</label>
                <input type="text" class="form-control" id="rating" name="rating" value="{{ $product->rating }}">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <select name="category" id="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->product_type == $product->product_type)>{{ $category->product_type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Подтвердить" class="btn">
        </form>
    </div>
@endsection
