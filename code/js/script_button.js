const buttons = document.querySelectorAll('.btn');

buttons.forEach(button => {
  button.addEventListener('mouseover', () => {
    button.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.2)'; /* Додати тінь */
  });

  button.addEventListener('mouseout', () => {
    button.style.boxShadow = 'none'; /* Видалити тінь */
  });
});
