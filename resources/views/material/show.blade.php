@extends('layouts.master')

@section('title', $material->name)

@section('content')
    <div class="card text-center mt-3">
        <div class="card-header">
            {{ $material->category->name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="card-title">{{ $material->name }}</h5>
                    <p class="card-text">{!! $material->content !!}</p>
                </div>

                <div class="col-md-2">
                    @if ($material->user_id == auth()->user()->id)
                        <a href="{{ route('material.edit', $material->slug) }}" class="btn btn-outline-warning mb-2">edit</a>
                    @endif

                    @if ($material->user_id == auth()->user()->id || auth()->user()->can('delete-material'))
                        <form action="{{ route('material.destroy', $material->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Удалить материал" class="btn btn-outline-danger">
                        </form>
                    @endif

                    <a href="{{ route('favourite.toggleActive', $material->id) }}">
                        {{ auth()->user()->hasFavourite($material->id) ? 'Удалить из избранного' : 'В избранное' }}</a>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            {{ $material->created_at->format('Y:m:d H:i:s') }}
        </div>
    </div>
@endsection
