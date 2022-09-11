@extends('layouts.master')

@section('title', 'Добавление материала')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
    <h1>Добавление материала</h1>
    <form action="{{ route('material.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" required placeholder='Заголовок' value="{{ old('name') }}" name="name">
        </div>
        @include('includes.validation_message', ['fieldName' => 'name'])

        <br>
        <div class="form-group">
            <textarea class="form-control" name="description" required placeholder="Описание" name="description">{{ old('description') }}</textarea>
        </div>
        @include('includes.validation_message', ['fieldName' => 'description'])

        <br>
        <div class="form-group">
            <textarea class="form-control" id="summernote" required placeholder='Контент' name="content">{{ old('content') }}</textarea>
        </div>
        @include('includes.validation_message', ['fieldName' => 'content'])

        <br>
        <div class="form-group">
            <select name="category_id" class="form-control">
                <option value="" disabled>Выберите категорию</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(!is_null(old('category_id')) && $category->id == old('category_id'))>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @include('includes.validation_message', ['fieldName' => 'category_id'])

        <br>
        <input type="submit" class="btn btn-success" value="Добавить материал">
    </form>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#summernote').summernote();
        });
    </script>
@endsection
