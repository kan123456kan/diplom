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
    <div class="category-create">
        <form action="/category-create/" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <input type="submit" value="Подтвердить" class="btn">
        </form>
    </div>
@endsection
