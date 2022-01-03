module.exports = {
    env: {
        node: true,
        'vue/setup-compiler-macros': true
    },
    extends: [
        'eslint:recommended',
        'plugin:vue/vue3-recommended',
        '@vue/typescript'
    ],
    plugins: [
        'vuejs-accessibility',
    ],
    rules: {
        // override/add rules settings here, such as:
        'vue/no-unused-vars': 'error',
        'vue/html-indent': ["error", 4, {
            "attribute": 1,
            "baseIndent": 1,
            "closeBracket": 0,
            "alignAttributesVertically": true,
            "ignores": []
        }],
        // "vue/max-attributes-per-line": ["error", {
        //     "singleline": {
        //         "max": 2
        //     },
        //     "multiline": {
        //         "max": 2
        //     }
        // }],
        "vue/first-attribute-linebreak": ["error", {
            "singleline": "ignore",
            "multiline": "below"
        }],
        "vue/no-spaces-around-equal-signs-in-attribute": ['warn']
    }
}
