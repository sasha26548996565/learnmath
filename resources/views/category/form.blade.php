@extends('layouts.master')

@section('title', 'Добавление категории')

@section('content')
    <h2>Добавление категории</h2>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" name="name" required placeholder="Название" value="{{ old('name') }}" class="form-control">
        </div>
        <br>

        <input type="submit" class="btn btn-success" value="Добавить категорию">
    </form>
@endsection
