<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">LEARNMATH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">Категории</a>
                </li>
                @auth
                    @can('add-material')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('material.create') }}">Добавить материал</a>
                        </li>
                    @endcan
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-outline-dark" value="Выход">
                    </form>
                @else
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Вход</a>
                    </li>
                @endauth
            </ul>
            <form class="d-flex" action="{{ route('search') }}" method="GET">
                <input class="form-control me-2" type="search" name="search" value="{{ $_GET['search'] ?? '' }}" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
