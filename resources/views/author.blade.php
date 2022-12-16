@extends('layouts.master')

@section('title', 'Автор: '. $author->name)

@section('content')
    <div class="d-flex justify-content-around">
        <h4>Автор: {{ $author->name }}</h4>
        @if ((auth()->user()->id != $author->id) && (auth()->user()->isSubscriped($author->id) == false))
            <div><a href="{{ route('author.subscription', $author->id) }}" class="btn btn-danger">Подписаться</a></div>
        @endif
    </div>

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
