// Отримуємо модальне вікно та кнопку для закриття
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

// Функція для відкриття модального вікна
function openModal() {
  modal.style.display = "block";
}

// Функція для закриття модального вікна
span.onclick = function() {
  modal.style.display = "none";
}

// Закриття модального вікна, коли користувач клікає за межами вікна
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
