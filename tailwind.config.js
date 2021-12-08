const defaultTheme = require('tailwindcss/defaultTheme');

const plugin = require("tailwindcss/plugin");

const focusedSiblingPlugin = plugin(function ({ addVariant, e }) {
  addVariant("focused-sibling", ({ container }) => {
    container.walkRules((rule) => {
      rule.selector = `:focus + .focused-sibling\\:${rule.selector.slice(1)}`;
    });
  });
});

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // or 'media' or 'class'
    theme: {
        extend: {
            fontSize: {
                'xxxs': '.3rem',
                'xxs': '.6rem',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                mont: ['Montserrat'],
                robo: ['Roboto'],
            },
            colors: {
                'primary': '#29AFC7',
                'washed-primary': '#BCE6EE',
            },
            backgroundColor: theme => ({
                'light': '#f0f0f0',
                'lighter': '#f5f6fa',
                'lightest': '#f9f9f9',

                'dark-1': '#3b3b41',
                'dark-2': '#323236',
                'darker-1': '#2f2f33',
                'darker-2': '#28282b',
                'darkest-1': '#232326',
                'darkest-2': '#1e1e21',
            }),
            borderColor: theme => ({
                'light': '#b5b5b5',
                'lighter': '#dbdbdb',
                'lightest': '#e3e3e3',

                'dark': '#404046',
                'darker': '#37373b',
                'darkest': '#2d2d31',
            }),
            textColor: theme => ({
                'light': '#999999',
                'lighter': '#cecece',

                'darker': '#283252',
                'dark': '#a2a5b9',
            }),
            placeholderColor: theme => ({
                'light': '#999999',
                'lighter': '#cecece',

                'darker': '#283252',
                'dark': '#a2a5b9',
            }),
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/line-clamp'),
        focusedSiblingPlugin,
        
    ],
};