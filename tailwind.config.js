import defaultTheme from 'tailwindcss/defaultTheme';

const { addDynamicIconSelectors } = require('@iconify/tailwind');

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
                sans: ['SF Pro Display', ...defaultTheme.fontFamily.sans],

            },
            colors : {
                greenPrimary : '#A2E554',
                primaryHover : '#6C9838',
                greenSecondary : '#114232',
                greenHover : '#082119',
                yellowPrimary : '#FFEB3B',
                yellowSecondary : '#FFC107',
                primaryBg : '#E2F7CA',
                greenTertiary : '#B9E7B7',
            }
        },
    },
    plugins: [
        require('preline/plugin'),
        addDynamicIconSelectors({
            include: ['**/*.blade.php'],
        }),
    ],
};
