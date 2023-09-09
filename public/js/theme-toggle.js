// Function to toggle between light and dark themes
var pcoded = document.getElementById('pcoded');

function toggleTheme() {
    console.log('theme toggle');
    let newTheme;
    if (pcoded.getAttribute('layout-type') === 'dark') {
        newTheme = 'light'
        pcoded.setAttribute('layout-type', 'light');
        pcoded.setAttribute('header-theme', 'theme1');
        pcoded.setAttribute('navbar-theme', 'themelight1');
        pcoded.setAttribute('logo-theme', 'theme1');
    } else {
        newTheme = 'dark'
        pcoded.setAttribute('layout-type', 'dark');
        pcoded.setAttribute('header-theme', 'theme6');
        pcoded.setAttribute('navbar-theme', 'theme1');
        pcoded.setAttribute('logo-theme', 'theme6');
    }

    localStorage.setItem('theme', newTheme);
}

const themeToggle = document.getElementById('theme-toggle');
if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
}

// Check if there's a saved theme in localStorage
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    // Apply the saved theme
    var pcoded = document.getElementById('pcoded');
    pcoded.setAttribute('layout-type', savedTheme);
}
