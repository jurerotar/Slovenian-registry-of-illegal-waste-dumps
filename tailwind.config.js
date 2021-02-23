module.exports = {
    purge: {
        content: [
            'resources/js/**/*.vue',
        ]
    },
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Montserrat', 'sans-serif']
            },
            borderWidth: {
                'default': '1px'
            },
            minWidth: {
                'table': '700px'
            },
            maxWidth: {
                'main': '1400px',
                'nav': 'calc(100% - 18rem)',
                'export': '40rem'
            },
            borderColor: {
                'green-default': 'var(--green-default)',
            },
            color: {
                'dark-main': 'var(--dark-main)',
                'dark-nav': 'var(--dark-navigation)',
                'green-default': 'var(--green-default)',
                'green-default-darker': 'var(--green-default-darker)'
            },
            backgroundColor: {
                'dark-main': 'var(--dark-main)',
                'dark-nav': 'var(--dark-navigation)',
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
