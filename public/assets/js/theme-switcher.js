//***********************************************************************
// Theme Switcher JavaScript
// Description: Toggles between light and dark themes.
// Uses Bootswatch themes: Litera (light) and Slate (dark)
// Saves preference in localStorage
//***********************************************************************

(function() {
    // Theme URLs from Bootswatch CDN
    var THEMES = {
        litera: 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/litera/bootstrap.min.css',
        slate:  'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/slate/bootstrap.min.css'
    };
    var STORAGE_KEY = 'grammar_theme';

    // Set the active theme
    function setTheme(theme) {
        var link = document.getElementById('theme-stylesheet');
        if (link) {
            link.href = THEMES[theme];
        }
        // Set data attribute for CSS custom properties
        document.documentElement.setAttribute('data-bs-theme', theme === 'slate' ? 'dark' : 'light');
        localStorage.setItem(STORAGE_KEY, theme);
    }

    // Get stored theme preference
    function getStoredTheme() {
        return localStorage.getItem(STORAGE_KEY) || 'litera';
    }

    // Toggle button handler - switches between themes
    window.toggleTheme = function() {
        var current = getStoredTheme();
        var next = current === 'litera' ? 'slate' : 'litera';
        setTheme(next);
    };

    // Initialize theme on page load
    setTheme(getStoredTheme());
})();