$(document).ready(function () {
    const pcoded = document.getElementById('pcoded');
    const themeToggle = document.getElementById('theme-toggle');
    let savedTheme = localStorage.getItem('theme');

    function setTheme(theme) {
        if (theme === 'dark') {
            // Switch to the dark theme
            pcoded.setAttribute('layout-type', 'dark');
            $('.pcoded-header').attr('header-theme', 'theme6');
            pcoded.setAttribute('navbar-theme', 'theme6');
            pcoded.setAttribute('logo-theme', 'theme6');

            // Add dark theme styles...
            $('.table, .dropdown, .notification-menu, .notification-toggle, .notification-view').removeClass('text-dark').addClass('text-light');
            $('.dropdown-icon, .dropdown-menu, .notification-menu, .auth_name, .notification-toggle, .dropdown-icon, .notification-msg, .notification-time, .notification-view').addClass('text-light');

            // Set modal input fields background to transparent
            $('.modal-content input').css('background', 'transparent');

            // Set modal input fields text color to white
            $('.modal-content input').css('color', 'white');

             // Set select option background to transparent
            $('.modal-content select option').css('background', '#333');

            // Set select option text color to white
            $('.modal-content select option').css('color', 'white');
                      
            // Style FST Dropdown select options
            $('.fstdropdown').css({
                'background-color': '#333',
                'color': 'white',
            });

            $(themeToggle).html('<i class="feather icon-sun f-50 text-c-dark"></i> Light mode');

            // Apply dark mode styles to modals immediately
            applyDarkModeToModals();

          

        } else {
            // Switch to the light theme
            pcoded.setAttribute('layout-type', 'light');
            $('.pcoded-header').attr('header-theme', 'theme1');
            pcoded.setAttribute('navbar-theme', 'theme1');
            pcoded.setAttribute('logo-theme', 'theme1');

            // Add light theme styles...
            $('.table, .dropdown, .notification-menu, .notification-toggle, .notification-view').removeClass('text-light').addClass('text-dark');
            $('.dropdown-menu, .dropdown-icon, .notification-menu, .notification-toggle, .notification-view').addClass('text-dark');

            $('.modal, .modal-content').removeClass('dark-modal-background');

            // Set modal input fields background to default
            $('.modal-content input').css('background', '');

            $('.modal-content input').css('color', '');

             // Set select option background to default
             $('.modal-content select option').css('background', '');

             // Set select option text color to default
             $('.modal-content select option').css('color', '');

            // Style FST Dropdown select options
            $('.fstdropdown').css({
                'background-color': '',
                'color': '',
            });

            $(themeToggle).html('<i class="feather icon-moon f-50 text-c-dark"></i> Dark mode');

            // Remove dark mode styles from modals immediately
            removeDarkModeFromModals();
        }
    }

    // Apply the saved theme or default to 'light'
    if (!savedTheme) {
        savedTheme = 'light';
    }
    setTheme(savedTheme);

    // Toggle the theme and update local storage
    themeToggle.addEventListener('click', function () {
        const currentTheme = pcoded.getAttribute('layout-type');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    });

    // Event listener for modal shown event on the document
    $(document).on('shown.bs.modal', '.modal', function () {
        const currentTheme = pcoded.getAttribute('layout-type');
        if (currentTheme === 'dark') {
            applyDarkModeToModals();
        }
    });

    // Event listener for modal hidden event on the document
    $(document).on('hidden.bs.modal', '.modal', function () {
        removeDarkModeFromModals();
    });

    // Function to apply dark mode to all modals
    function applyDarkModeToModals() {
        $('.modal-content, .card, .card-body').addClass('dark-mode');
    }

    // Function to remove dark mode from all modals
    function removeDarkModeFromModals() {
        $('.modal-content, .card, .card-body').removeClass('dark-mode');
    }
});





// $(document).ready(function () {
//     const pcoded = document.getElementById('pcoded');
//     const themeToggle = document.getElementById('theme-toggle');
//     let savedTheme = localStorage.getItem('theme');

//     function setTheme(theme) {
//         if (theme === 'dark') {
//             // Switch to the dark theme
//             pcoded.setAttribute('layout-type', 'dark');
//             $('.pcoded-header').attr('header-theme', 'theme6');
//             pcoded.setAttribute('navbar-theme', 'theme6');
//             pcoded.setAttribute('logo-theme', 'theme6');

//             // Add dark theme styles...
//             $('.table, .dropdown, .notification-menu, .notification-toggle, .notification-view').removeClass('text-dark').addClass('text-light');
//             $('.dropdown-icon, .dropdown-menu, .notification-menu, .auth_name, .notification-toggle, .dropdown-icon, .notification-msg, .notification-time, .notification-view').addClass('text-light');

//             $(themeToggle).html('<i class="feather icon-sun f-50 text-c-dark"></i> Light mode');

//             // Apply dark mode styles to modals immediately
//             applyDarkModeToModals();

//         } else {
//             // Switch to the light theme
//             pcoded.setAttribute('layout-type', 'light');
//             $('.pcoded-header').attr('header-theme', 'theme1');
//             pcoded.setAttribute('navbar-theme', 'theme1');
//             pcoded.setAttribute('logo-theme', 'theme1');

//             // Add light theme styles...
//             $('.table, .dropdown, .notification-menu, .notification-toggle, .notification-view').removeClass('text-light').addClass('text-dark');
//             $('.dropdown-menu, .dropdown-icon, .notification-menu, .notification-toggle, .notification-view').addClass('text-dark');

//             $('.modal, .modal-content').removeClass('dark-modal-background');

//             $(themeToggle).html('<i class="feather icon-moon f-50 text-c-dark"></i> Dark mode');

//             // Remove dark mode styles from modals immediately
//             removeDarkModeFromModals();
//         }
//     }

//     // Apply the saved theme or default to 'light'
//     if (!savedTheme) {
//         savedTheme = 'light';
//     }
//     setTheme(savedTheme);

//     // Toggle the theme and update local storage
//     themeToggle.addEventListener('click', function () {
//         const currentTheme = pcoded.getAttribute('layout-type');
//         const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
//         setTheme(newTheme);
//         localStorage.setItem('theme', newTheme);
//     });

//     // Event listener for modal shown event on the document
//     $(document).on('shown.bs.modal', '.modal', function () {
//         const currentTheme = pcoded.getAttribute('layout-type');
//         if (currentTheme === 'dark') {
//             applyDarkModeToModals();
//         }
//     });

//     // Event listener for modal hidden event on the document
//     $(document).on('hidden.bs.modal', '.modal', function () {
//         removeDarkModeFromModals();
//     });

//     // Function to apply dark mode to all modals
//     function applyDarkModeToModals() {
//         $('.modal-content, .card, .card-body').addClass('dark-mode');
//     }

//     // Function to remove dark mode from all modals
//     function removeDarkModeFromModals() {
//         $('.modal-content, .card, .card-body').removeClass('dark-mode');
//     }
// });
