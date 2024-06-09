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
        <form action="/product-create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" step="0.1" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Количество</label>
                <input type="number" class="form-control" id="qty" name="qty" required>
            </div>
            <div class="mb-3">
                <label for="flavor" class="form-label">Аромат</label>
                <input type="text" class="form-control" id="flavor" name="flavor" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="img" name="img"
                    placeholder="Введите название изображения с расширением файла из..." required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Страна-производитель</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Рейтинг</label>
                <input type="number" class="form-control" id="rating" name="rating" max="5" min="1" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <select id="category" name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->product_type }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn" value="Подтвердить">
        </form>
    </div>
@endsection
