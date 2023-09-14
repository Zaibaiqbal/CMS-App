$(document).ready(function () {
    const pcoded = document.getElementById('pcoded');
    const themeToggle = document.getElementById('theme-toggle');
    const savedTheme = localStorage.getItem('theme');

    // Function to set the theme based on the 'layout-type' attribute
    function setTheme(theme) {

        if (theme === 'dark') {

            // Switch to the dark theme
            pcoded.setAttribute('layout-type', 'dark');
            pcoded.setAttribute('header-theme', 'theme6');
            pcoded.setAttribute('navbar-theme', 'theme1');
            pcoded.setAttribute('logo-theme', 'theme6');
            $('.table').removeClass('text-dark');
            $('.dropdown').removeClass('text-dark');
            $('.table').addClass('text-light');
            $('.dropdown').addClass('text-light');
            $('.dropdown-icon').addClass('text-light');
            
        } else {
            // Switch to the light theme
            pcoded.setAttribute('layout-type', 'light');
            pcoded.setAttribute('header-theme', 'theme1');
            pcoded.setAttribute('navbar-theme', 'themelight1');
            pcoded.setAttribute('logo-theme', 'theme1');
            $('.table').removeClass('text-light');
            $('.dropdown').removeClass('text-light');
            $('.table').addClass('text-dark');
            $('.dropdown').addClass('text-dark');
        }
    }

    // Apply the saved theme or default to 'light'
    if (savedTheme) {
        setTheme(savedTheme);
    } else {
        setTheme('light');
    }

    // Toggle the theme and update local storage
    themeToggle.addEventListener('click', function () {
        const currentTheme = pcoded.getAttribute('layout-type');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });
});
