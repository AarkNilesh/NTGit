document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-confirm]').forEach((button) => {
    button.addEventListener('click', (event) => {
      if (!window.confirm(button.dataset.confirm)) event.preventDefault();
    });
  });

  const nameInput = document.querySelector('#full_name');
  const preview = document.querySelector('#name-preview');
  if (nameInput && preview) {
    nameInput.addEventListener('input', () => {
      preview.textContent = nameInput.value ? `Generating chart for ${nameInput.value}` : 'Enter a client name to begin.';
    });
  }
});
