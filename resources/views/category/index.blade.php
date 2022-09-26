@extends('layouts.master')

@section('content')
    @can('add-category')
        <h2><a href="{{ route('category.create') }}">Добавить категорию</a></h2>
    @endcan

    @foreach ($categories as $category)
        <div class="card text-center mt-3">
            <div class="card-header">
                {{ $category->name }}
            </div>
            <div class="card-body d-flex justify-content-around">
                <div>
                    <a href="{{ route('category.show', $category->slug) }}" class="btn btn-primary">Просмотреть</a>
                </div>

                @auth
                    @if(count($category->user) > 0)
                        подписан
                    @else
                        <form action="{{ route('category.subscription', $category->id) }}" method="POST">
                            @csrf

                            <input type="submit" class="btn btn-info" value="Подписаться на категорию">
                        </form>
                    @endif
                @endauth

                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="submit" class="btn btn-danger" value="Удалить категорию">
                </form>
            </div>
            <div class="card-footer text-muted">
                {{ $category->created_at->format('Y:m:d H:i:s') }}
            </div>
        </div>
    @endforeach
    <br>

    {{ $categories->withQueryString()->links() }}
@endsection
