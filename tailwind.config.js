/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("daisyui"), require("tailwind-scrollbar-hide")],
    daisyui: {
        themes: ["bumblebee"],
    },
    // scrollbarHide: true,
};
