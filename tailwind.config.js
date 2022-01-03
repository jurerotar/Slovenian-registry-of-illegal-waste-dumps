const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'class',
    mode: 'jit',
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1440px',
            '2xl': '1920px',
        },
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            borderColor: {
                'green-default': 'var(--green-default)',
            },
            color: {
                'green-default': 'var(--green-default)',
                'green-default-darker': 'var(--green-default-darker)'
            },
            backgroundColor: {
                'green-default': 'var(--green-default)',
                'green-default-darker': 'var(--green-default-darker)'
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
