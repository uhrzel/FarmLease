import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", "Inter", "Roboto", "Nunito", "sans-serif"],
                serif: ["Merriweather", "Georgia", "serif"],
                mono: ["Fira Code", "Courier New", "monospace"],
                display: ["Oswald"],
                body: ["Open Sans"],
            },
        },
    },

    plugins: [forms],
    darkMode: "class",
};
