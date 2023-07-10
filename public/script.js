const CSRF_TOKEN = document.querySelector("meta[name='csrf-token']").content;

const textForm = document.querySelector(".text-form");
const sortForm = document.querySelector(".sort-form");

textForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const invalidFeedback = this.querySelector(".invalid-feedback");
  const textInput = this.querySelector(".text-input");
  const inputValue = textInput.value.trim();

  // Очищаем поле ввода
  textInput.value = "";

  post("/api/items/add", { body: inputValue }).then(function (res) {
    return res.json();
  }).then(function (data) {
    if (!data.errors) {
      window.location.reload();
    } else {
      textInput.classList.add("is-invalid");
      invalidFeedback.textContent = data.errors.body;
    }
  });
});

sortForm.addEventListener("change", function (e) {
  window.location.href = `/?sortField=${getSortField()}&sortOrder=${getSortOrder()}`;
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
  const invalidFeedback = editForm.querySelector(".invalid-feedback");
  const editInput = editForm.querySelector("input");
  const editValue = editInput.value.trim();

  post("/api/items/edit", { id: elementNode.id, newBody: editInput.value }).then(function (res) {
    return res.json();
  }).then(function (data) {
    if (!data.errors || data.errors.id) {
      window.location.reload();
      return;
    }
    editInput.classList.add("is-invalid");
    invalidFeedback.textContent = data.errors.newBody;

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
  post("/api/items/remove", { id: elementNode.id }).then(function () {
    window.location.reload();
  });
}

function getElementById(id) {
  return list.find(function (element) {
    return element.id === id;
  });
}

function getSortField() {
  const form = document.querySelector(".sort-form");
  const radios = form.querySelectorAll("input");

  // Находим выбранную сортировку
  for (const radio of radios) {
    if (radio.checked) {
      return radio.getAttribute("sort-field");
    }
  }
}

function getSortOrder() {
  if (sortForm.querySelector("#orderCheckbox").checked)
    return "desc";
  return "asc";
}

function post(url, data) {
  return fetch(url, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": CSRF_TOKEN,
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify(data)
  });
}