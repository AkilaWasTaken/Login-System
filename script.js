function toggleDarkMode() {
    var body = document.body;
    var theme = body.getAttribute('data-theme');
    var newTheme = theme === 'dark' ? 'light' : 'dark';
    body.setAttribute('data-theme', newTheme);
    

    localStorage.setItem('theme', newTheme);
}


document.addEventListener('DOMContentLoaded', function() {
    var theme = localStorage.getItem('theme');
    if (theme) {
        document.body.setAttribute('data-theme', theme);
    }
});
