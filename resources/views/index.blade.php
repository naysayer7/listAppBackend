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
    <main class="p-2">
        <div class="text-end">
            <a class="btn btn-outline-secondary logout-btn" href="/logout">Выйти</a>
        </div>
        <form class="sort-form">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sortRadio" id="idSortRadio" sort-field="id"
                    @if ($sortField === 'id') checked @endif>
                <label class="form-check-label" for="idSortRadio">
                    по номеру
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sortRadio" id="bodySortRadio" sort-field="body"
                    @if ($sortField === 'body') checked @endif>
                <label class="form-check-label" for="bodySortRadio">
                    по алфавиту
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sortCheck" id="orderCheckbox"
                    @if ($sortOrder === 'descending') checked @endif>
                <label class="form-check-label" for="orderCheckbox">
                    обратный порядок
                </label>
            </div>
        </form>
        <form class="row g-2 text-form" novalidate>
            <div class="col">
                <input type="text" class="form-control text-input" name="body" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary add-btn w-100">Добавить</button>
            </div>
        </form>
        <ul class="mt-2 list-group">
            @foreach ($items as $item)
                <li class="list-group-item" id="{{ $item->id }}">
                    <div class="text-end">{{ $item->id }}</div>
                    <div class="element-container">
                        <p>{{ $item->body }}</p>
                        <hr>
                        <button class="btn btn-secondary edit-btn">Редактировать</button>
                        <button class="btn-close remove-btn ms-2"></button>
                    </div>
                    <form class="edit-form" hidden>
                        <input class="form-control edit-input w-100" type="text">
                        <div class="invalid-feedback"></div>
                        <hr>
                        <button class="btn btn-success confirm-btn" type="submit">Ок</button>
                        <button class="btn btn-danger cancel-btn ms-2">Отмена</button>
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
