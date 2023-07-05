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
    </header>
    <main class="m-5">
        <form action="/register" method="POST" class="register-form" style="max-width: 450px">
            @csrf
            <div class="mb-3">
                <label for="nameInput" class="form-label">Имя</label>
                <input type="text" class="form-control" id="nameInput" name="name" required
                    value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" id="emailInput" aria-describedby="emailHelp" name="email" required
                    value="{{ old('email') }}"
                    class="form-control @error('email')
                     is-invalid
                 @enderror">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Пароль</label>
                <input type="password" id="passwordInput" name="password" required
                    class="form-control @error('password')
                     is-invalid
                 @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Подтвердить</button>
            <a href="/login" class="p-3">Войти</a>
        </form>
    </main>
    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
