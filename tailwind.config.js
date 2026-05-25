/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],

    // WAJIB ADA BAGIAN INI
    daisyui: {
        themes: ["light", "dark"],
    },
};
