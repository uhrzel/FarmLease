import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// DARK MODE TOGGLE BUTTON FOR DESKTOP & MOBILE
function setupThemeToggle(buttonId, darkIconId, lightIconId) {
    var themeToggleDarkIcon = document.getElementById(darkIconId);
    var themeToggleLightIcon = document.getElementById(lightIconId);
    var themeToggleBtn = document.getElementById(buttonId);

    // Check the theme and apply the correct icon visibility
    if (
        localStorage.getItem("color-theme") === "dark" ||
        (!("color-theme" in localStorage) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        themeToggleLightIcon.classList.remove("hidden");
    } else {
        themeToggleDarkIcon.classList.remove("hidden");
    }

    // Toggle event listener
    themeToggleBtn.addEventListener("click", function () {
        themeToggleDarkIcon.classList.toggle("hidden");
        themeToggleLightIcon.classList.toggle("hidden");

        // Toggle between dark and light mode
        if (localStorage.getItem("color-theme")) {
            if (localStorage.getItem("color-theme") === "light") {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            } else {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            }
        } else {
            if (document.documentElement.classList.contains("dark")) {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("color-theme", "light");
            } else {
                document.documentElement.classList.add("dark");
                localStorage.setItem("color-theme", "dark");
            }
        }
    });
}

// Initialize theme toggle for both desktop and mobile
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
