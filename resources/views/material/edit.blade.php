@extends('layouts.master')

@section('title', 'Редактирование материала ' .$material->name)

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
    <h1>Редактирование материала</h1>
    <form action="{{ route('material.update', $material->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <input type="text" class="form-control" required placeholder='Заголовок' value="{{ $material->name }}" name="name">
        </div>
        @include('includes.validation_message', ['fieldName' => 'name'])

        <br>
        <div class="form-group">
            <textarea class="form-control" name="description" required placeholder="Описание" name="description">
                {{ $material->description }}</textarea>
        </div>
        @include('includes.validation_message', ['fieldName' => 'description'])

        <br>
        <div class="form-group">
            <textarea class="form-control" id="summernote" required placeholder='Контент' name="content">
                {{ $material->content }}</textarea>
        </div>
        @include('includes.validation_message', ['fieldName' => 'content'])

        <br>
        <div class="form-group">
            <select name="category_id" class="form-control">
                <option value="" disabled>Выберите категорию</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == $material->category->id)>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @include('includes.validation_message', ['fieldName' => 'category_id'])

        <br>
        <input type="submit" class="btn btn-success" value="Обновить материал">
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
