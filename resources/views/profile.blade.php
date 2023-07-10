<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="/styles.css" rel="stylesheet" />
</head>

<body>
    <header>
        <nav class="p-2">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{ Auth::user()->avatar ? '/images/' . Auth::user()->avatar : '' }}" width="40px"
                    height="40px">
                {{ Auth::user()->email }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/">Главный экран</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/logout">Выйти</a></li>
            </ul>
        </nav>
    </header>
    <main class="p-2">
        <ul class="list-group">
            <li class="list-group-item">
                <form action="/profile/avatar" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Изменить аватар</label>
                        <input
                            class="form-control @error('image')
                    is-invalid
                @enderror"
                            type="file" id="formFile" name="image" required>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Подтвердить</button>
                </form>
            </li>
            <li class="list-group-item">
                <form action="/profile/addtgtoken" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Привязать телеграм бота</label>
                        <input type="text" id="tokenInput" placeholder="Токен" name="token" required
                            class="form-control @error('token')
                                                    is-invalid
                                                @enderror">
                        @error('token')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Привязать</button>
                    <a href="/profile/revoketgtoken"
                        class="btn btn-danger @if (Auth::user()->tokens()->where('name', 'tg-token')->get()->isEmpty()) disabled @endif">Удалить</a>
                </form>
            </li>
        </ul>
    </main>
    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
