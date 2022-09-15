@extends('layouts.master')

@isset($material)
    @section('title', 'Редактирование материала ' .$material->name)
@else
    @section('title', 'Добавление материала')
@endisset

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')
    @isset($material)
        <h1>Редактирование материала</h1>
    @else
        <h1>Добавление материала</h1>
    @endisset

    <form action="
        @isset($material)
            {{ route('material.update', $material->id) }}
        @else
            {{ route('material.store') }}
        @endisset
        " method="POST" enctype="multipart/form-data">
        @csrf

        @isset($material)
            @method('PATCH')
        @endisset

        <div class="form-group">
            <input type="text" class="form-control" required
                placeholder='Заголовок' value="{{ isset($material) ? $material->name : old('name') }}" name="name">
        </div>
        @include('includes.validation_message', ['fieldName' => 'name'])

        <br>
        <div class="form-group">
            <textarea class="form-control" name="description" required placeholder="Описание" name="description"
                >{{ isset($material) ? $material->description : old('description') }}</textarea>
        </div>
        @include('includes.validation_message', ['fieldName' => 'description'])

        <br>
        <div class="form-group">
            <textarea class="form-control" id="summernote" required placeholder='Контент' name="content"
                >{{ isset($material) ? $material->content : old('content') }}
            </textarea>
        </div>
        @include('includes.validation_message', ['fieldName' => 'content'])

        <br>
        <div class="form-group">
            <input type="file" class="form-control" name="preview">
        </div>
        @include('includes.validation_message', ['fieldName' => 'preview'])

        <br>
        <div class="form-group">
            <select name="category_id" class="form-control">
                <option value="" disabled>Выберите категорию</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @isset($material)
                            @selected($category->id == $material->category->id)
                        @else
                            @selected(!is_null(old('category_id')) && $category->id == old('category_id'))
                        @endisset
                        >
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @include('includes.validation_message', ['fieldName' => 'category_id'])

        <br>
        <input type="submit" class="btn btn-success" value="{{ isset($material) ? 'Обновить материал' : 'Добавить материал' }}">
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
