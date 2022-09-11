@extends('layouts.master')

@section('title', $material->name)

@section('content')
    <div class="card text-center mt-3">
        <div class="card-header">
            {{ $material->category->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $material->name }}</h5>
            <p class="card-text">{!! $material->content !!}</p>
        </div>
        <div class="card-footer text-muted">
            {{ $material->created_at->format('Y:m:d H:i:s') }}
        </div>
    </div>
@endsection
