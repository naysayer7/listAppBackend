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
        <form action="/login" method="POST" class="login-form" style="max-width: 450px">
            @csrf
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" id="emailInput" aria-describedby="emailHelp" name="email" required
                    value="{{ old('email') }}" class="form-control @error('form') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Пароль</label>
                <input type="password" id="passwordInput" name="password" required
                    class="form-control @error('form') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('form')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
            <a href="/register" class="p-3">Зарегистрироваться</a>
        </form>
    </main>
    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
