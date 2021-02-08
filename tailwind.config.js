module.exports = {
    purge: [],
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
                'nav': 'calc(100% - 15rem)',
                'export': '40rem'
            },
            backgroundColor: {
                'dark-main': '#18191A',
                'dark-nav': '#14171a',
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
