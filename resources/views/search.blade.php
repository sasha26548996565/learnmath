@extends('layouts.master')

@section('content')
    <h4>Фильтр по категориям</h4>
    <form method="GET">
        <select name="category_id" class="form-select">
            <option value="" disabled>Выберите категорию</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>

        <input type="submit" class="btn btn-outline-success" value="Применить">
    </form>
    <br>

    <h5>Результаты поиска: {{ $_GET['search'] }}</h5>
    @foreach ($materials as $material)
        <div class="card text-center mt-3">
            <div class="card-header">
                {{ $material->category->name }}
            </div>
            <div class="card-body">
                <img src="{{ Storage::url($material->preview) }}" alt="{{ $material->name }}" height="250" class="img-card-top">
                <h5 class="card-title">{{ $material->name }}</h5>
                <p class="card-text">{{ $material->description }}</p>
                <a href="{{ route('material.show', $material->slug) }}" class="btn btn-primary">Просмотреть</a>
            </div>
            <div class="card-footer text-muted">
                {{ $material->created_at->format('Y:m:d H:i:s') }}
            </div>
        </div>
    @endforeach
    <br>

    {{ $materials->withQueryString()->links() }}
@endsection
