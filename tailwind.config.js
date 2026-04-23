import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                serif: ['Merriweather', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                bmkg: {
                    navy:   '#003366',
                    blue:   '#0057A8',
                    light:  '#1A78C2',
                    gold:   '#21AA93',
                    lgold:  '#E8C34A',
                    sky:    '#E8F4FF',
                    dark:   '#001F3F',
                }
            }
        },
    },

    plugins: [forms],
};
