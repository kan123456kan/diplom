@extends('layouts.app')
@section('content')
    <div class="category-edit">
        <form action="/category-update/{{ $category->id }}" method="post">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $category->product_type }}">
            </div>
            <input type="submit" value="Подтвердить">
        </form>
    </div>
@endsection
