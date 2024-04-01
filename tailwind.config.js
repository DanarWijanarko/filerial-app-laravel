/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            poppins: ["Poppins", "ui-sans-serifui-sans-serif"],
        },
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};
