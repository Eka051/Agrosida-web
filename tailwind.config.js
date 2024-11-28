import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                greenPrimary : '#A2E554',
                greenSecondary : '#114232',
                yellowPrimary : '#FFEB3B',
                yellowSecondary : '#FFC107',
                primaryBg : '#E2F7CA'
            }
        },
    },
    plugins: [
        require('preline/plugin'),
    ],
};
