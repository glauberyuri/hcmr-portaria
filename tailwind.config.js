import forms from '@tailwindcss/forms';
import elements from 'tw-elements/dist/plugin.cjs';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/tw-elements/dist/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree'],
            },
        },
    },

    plugins: [forms, elements],
};
