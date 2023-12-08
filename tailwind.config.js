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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
    module:exports = {
        theme: {
          extend: {
            colors: {
              lilac: '#C8A2C8', // Example lilac color; adjust as needed
              'lilac-light': '#E4CCE6' // Lighter lilac for hover states
            },
          },
        },
        // ...
      }
};
