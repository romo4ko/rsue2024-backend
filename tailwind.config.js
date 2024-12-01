
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'title-color': '#293b29',
                'icons': '#f4fbf4',
                'subtitle': '#738373',
                'hover-title': '#248124'
            },
            boxShadow: {
                'card': '0 2px 15px 0 rgba(208, 217, 208, 0.5)',
            },
        },
    },
    plugins: [],
};
