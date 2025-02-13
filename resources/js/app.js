import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// DARK MODE TOGGLE BUTTON
function setupThemeToggle(buttonId, darkIconId, lightIconId) {
    var themeToggleDarkIcon = document.getElementById(darkIconId);
    var themeToggleLightIcon = document.getElementById(lightIconId);
    var themeToggleBtn = document.getElementById(buttonId);
    function applyTheme(theme) {
        if (theme === "dark") {
            document.documentElement.classList.add("dark");
            themeToggleDarkIcon.classList.add("hidden");
            themeToggleLightIcon.classList.remove("hidden");
            localStorage.setItem("color-theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            themeToggleDarkIcon.classList.remove("hidden");
            themeToggleLightIcon.classList.add("hidden");
            localStorage.setItem("color-theme", "light");
        }
    }
    const savedTheme = localStorage.getItem("color-theme");
    if (savedTheme) {
        applyTheme(savedTheme);
    } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        applyTheme("dark");
    } else {
        applyTheme("light");
    }

    // Toggle theme on button click
    themeToggleBtn.addEventListener("click", function () {
        const currentTheme = document.documentElement.classList.contains("dark")
            ? "light"
            : "dark";
        applyTheme(currentTheme);
    });
}
setupThemeToggle(
    "theme-toggle",
    "theme-toggle-dark-icon",
    "theme-toggle-light-icon"
);
setupThemeToggle(
    "theme-toggle-mobile",
    "theme-toggle-dark-icon-mobile",
    "theme-toggle-light-icon-mobile"
);
