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
                'nav': 'calc(100% - 18rem)',
                'export': '40rem'
            },
            color: {
                'dark-main': '#18191A',
                'dark-nav': '#14171a',
                'green-default': '#9DC02E',
                'green-default-darker': '#8dac29'
            },
            backgroundColor: {
                'dark-main': '#18191A',
                'dark-nav': '#242526',
                'green-default': '#9DC02E',
                'green-default-darker': '#8dac29'
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
