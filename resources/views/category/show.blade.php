@extends('layouts.master')

@section('title', 'Категория: '. $category->name)

@section('content')
    <h2>{{ $category->name }}</h2>

    @foreach ($materials as $material)
        <div class="card text-center mt-3">
            <div class="card-header">
                {{ $category->name }}
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
