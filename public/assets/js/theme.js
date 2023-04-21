const toggleTheme = () => {
  document.body.classList.toggle('dark');

  localStorage.setItem('theme', (
    (document.getElementsByClassName('dark').length !== 0) ? 'dark' : 'light'
  ));
}

document.addEventListener('DOMContentLoaded', () => {
  const themeToggler = document.getElementById('theme-toggler');
  if (themeToggler != null) {
    themeToggler.addEventListener('click', toggleTheme);
    themeToggler.checked = !(localStorage.getItem('theme') === 'dark');
  }

  if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark');
  }
});