@extends('layouts.master')

@section('content')
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
            <p>Автор: <a href="{{ route('author.show', $material->author->email) }}">{{ $material->author->name }}</a></p>
            {{ $material->created_at->format('Y:m:d H:i:s') }}
        </div>
    </div>
    @endforeach

    {{ $materials->withQueryString()->links() }}
@endsection
