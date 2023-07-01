const CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").content;

const textForm = document.querySelector(".text-form");
const sortForm = document.querySelector(".sort-form");

textForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const textInput = this.querySelector(".text-input");
  const inputValue = textInput.value.trim();

  // Очищаем поле ввода
  textInput.value = "";

  // Валидация текста
  if (!inputValue) {
    textInput.classList.add("is-invalid");
    return;
  }

  post("/add", { body: inputValue }).then(function () {
    window.location.reload();
  });
});

sortForm.addEventListener("change", function (e) {
  window.location.href = `/?sortType=${getSelectedSort()}`;
});

document.addEventListener("click", function (e) {
  let target = e.target.closest(".edit-btn");
  if (target) {
    onEditClick(target, e);
    return;
  }

  target = e.target.closest(".remove-btn");
  if (target) {
    onRemoveClick(target, e);
    return;
  }

  target = e.target.closest(".confirm-btn");
  if (target) {
    onConfirmClick(target, e);
    return;
  }

  target = e.target.closest(".cancel-btn");
  if (target) {
    onCancelClick(target, e);
    return;
  }
});

function onEditClick(target, e) {
  const elementContainer = target.closest(".element-container");
  const elementBody = elementContainer.querySelector("p").textContent;
  const elementNode = target.closest("li");
  const editForm = elementNode.querySelector(".edit-form");
  const editInput = editForm.querySelector("input");

  // Скрыть элемент и показать форму редактирования
  elementContainer.hidden = true;
  editForm.hidden = false;

  // Меняем текст поля на текст элемента
  editInput.value = elementBody;
}

function onConfirmClick(target, e) {
  e.preventDefault();

  const elementNode = target.closest("li");
  const editForm = target.closest(".edit-form");
  const editInput = editForm.querySelector("input");
  const editValue = editInput.value.trim();

  // Валидация отредактированного текста
  if (!editValue) {
    editInput.classList.add("is-invalid");
    return;
  }

  post("/edit", { id: elementNode.id, newBody: editValue }).then(function () {
    window.location.reload();
  });
}

function onCancelClick(target, e) {
  e.preventDefault();

  const elementNode = target.closest("li");
  const elementContainer = elementNode.querySelector(".element-container");
  const editForm = target.closest(".edit-form");
  const editInput = editForm.querySelector("input");

  // Скрыть форму редактирования и показать элемент
  editForm.hidden = true;
  elementContainer.hidden = false;

  // Убираем ошибку валидации, если она была
  editInput.classList.remove("is-invalid");
}

function onRemoveClick(target, e) {
  const elementNode = target.closest("li");
  post("/remove", { id: elementNode.id }).then(function () {
    window.location.reload();
  });
}

function addElement(element) {
  list.push(element);
  sortList();
}

function getElementById(id) {
  return list.find(function (element) {
    return element.id === id;
  });
}

function getSelectedSort() {
  const form = document.querySelector(".sort-form");
  const radios = form.querySelectorAll("input");

  // Находим выбранную сортировку
  for (const radio of radios) {
    if (radio.checked) {
      return radio.getAttribute("sort");
    }
  }
}

function post(url, data) {
  return fetch(url, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": CSRF_TOKEN,
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });
}