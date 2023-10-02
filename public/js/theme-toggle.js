$(document).ready(function () {
    const pcoded = document.getElementById('pcoded');
    const themeToggle = document.getElementById('theme-toggle');
    const savedTheme = localStorage.getItem('theme');
    // Function to set the theme based on the 'layout-type' attribute
    function setTheme(theme) {

        if (theme === 'dark') {

            // Switch to the dark theme
            pcoded.setAttribute('layout-type', 'dark');
            // pcoded.setAttribute('header-theme', 'theme6');
            $('.pcoded-header').attr("header-theme", 'theme6');
            pcoded.setAttribute('navbar-theme', 'theme6');
            pcoded.setAttribute('logo-theme', 'theme6');
            $('.table').removeClass('text-dark');
            $('.dropdown').removeClass('text-dark');
            $('.notification-menu').removeClass('text-dark');
            $('.notification-toggle').removeClass('text-dark');
            $('.notification-view').removeClass('text-dark');



            $('.table').addClass('text-light');
            $('.dropdown').addClass('text-light');
            $('.dropdown-icon').addClass('text-light');
            $('.dropdown-menu').addClass('text-light');
            $('.notification-menu').addClass('text-light');
            $('.auth_name').addClass('text-light');
            $('.notification-toggle').addClass('text-light');
            $('.dropdown-icon').addClass('text-light');
            $('.notification-msg').addClass('text-light');
            $('.notification-time').addClass('text-light');
            // $('.notification-toggle').addClass('text-light');
            $('.notification-view').addClass('text-light');
            $('.modal-content').addClass('text-light');
            $('.modal-content').addClass('bg-dark');

            

            $(themeToggle).html('<i class="feather icon-sun f-50 text-c-dark"></i> Light mode');

            
        } else {
            // Switch to the light theme
            pcoded.setAttribute('layout-type', 'light');
            // pcoded.setAttribute('header-theme', 'theme1');
            $('.pcoded-header').attr("header-theme", 'theme1');
            pcoded.setAttribute('navbar-theme', 'theme1');
            pcoded.setAttribute('logo-theme', 'theme1');
            $('.table').removeClass('text-light');
            $('.dropdown').removeClass('text-light');
            $('.notification-menu').removeClass('text-light');
            $('.notification-toggle').removeClass('text-light');
            $('.notification-view').removeClass('text-light');



            $('.table').addClass('text-dark');
            $('.dropdown').addClass('text-dark');
            $('.dropdown-menu').addClass('text-dark');

            $('.notification-menu').addClass('text-dark');
            $('.dropdown-icon').addClass('text-dark');
           
            $('.notification-toggle').addClass('text-dark');
            $('.notification-view').addClass('text-dark');

            $('.notification-msg').addClass('text-dark');
            $('.notification-time').addClass('text-dark');
            $(themeToggle).html('<i class="feather icon-moon f-50 text-c-dark"></i> Dark mode');

            

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
