<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Список</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="/styles.css" rel="stylesheet" />
</head>

<body>
    <header>
    </header>
    <main>
        <form class="p-5 sort-form">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sortRadio" id="incIdRadio" sort="incId"
                    @if ($sortType === 'incId') checked @endif>
                <label class="form-check-label" for="incIdRadio">
                    по возрастанию номера
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sortRadio" id="decIdRadio" sort="decId"
                    @if ($sortType === 'decId') checked @endif>
                <label class="form-check-label" for="decIdRadio">
                    по убыванию номера
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sortRadio" id="alphabetRadio" sort="alphabet"
                    @if ($sortType === 'alphabet') checked @endif>
                <label class="form-check-label" for="alphabetRadio">
                    в алфавитном порядке
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sortRadio" id="invAlphabetRadio" sort="invAlphabet"
                    @if ($sortType === 'invAlphabet') checked @endif>
                <label class="form-check-label" for="invAlphabetRadio">
                    в обратном алфавитном порядке
                </label>
            </div>
        </form>
        <form class="row g-2 text-form" novalidate action="/" method="POST">
            <div class="col-md-4">
                <input type="text" class="form-control text-input" name="body" required>
                <div class="invalid-feedback">Введите непустую строку</div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary add-btn">Добавить</button>
            </div>
        </form>
        <ul class="list list-group">
            @foreach ($items as $item)
                <li class="list-group-item" id="{{ $item->id }}">
                    <div class="element-id">{{ $item->id }}</div>
                    <div class="element-container">
                        <p>{{ $item->body }}</p>
                        <hr>
                        <button class="btn btn-secondary edit-btn">Редактировать</button>
                        <button class="btn-close remove-btn"></button>
                    </div>
                    <form class="edit-form" hidden="">
                        <input class="form-control edit-input" type="text">
                        <div class="invalid-feedback">Введите непустую строку</div>
                        <hr>
                        <button class="btn btn-success confirm-btn" type="submit">Ок</button>
                        <button class="btn btn-danger cancel-btn">Отмена</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </main>
    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="/script.js"></script>
</body>

</html>
