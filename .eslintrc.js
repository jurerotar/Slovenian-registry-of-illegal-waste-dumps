module.exports = {
  root: true,
  env: {
    node: true,
    'vue/setup-compiler-macros': true,
    "browser": true,
    "es2021": true,
  },
  "extends": [
    "plugin:vue/vue3-recommended",
    "eslint:recommended",
    "@vue/typescript/recommended"
  ],
  "parserOptions": {
    "ecmaVersion": 2021
  },
  plugins: [
    'vuejs-accessibility',
    '@typescript-eslint'
  ],
  rules: {
    // override/add rules settings here, such as:
    'max-len': [
      "error", {
        "code": 140,
        "tabWidth": 2
      }],
    'vue/no-unused-vars': 'error',
    'vue/html-indent': ["error", 2, {
      "attribute": 1,
      "baseIndent": 1,
      "closeBracket": 0,
      "alignAttributesVertically": true,
      "ignores": []
    }],
    "vue/first-attribute-linebreak": ["error", {
      "singleline": "ignore",
      "multiline": "below"
    }],
    "vue/no-spaces-around-equal-signs-in-attribute": ['warn'],
    "@typescript-eslint/ban-ts-comment": "off",
    '@typescript-eslint/no-non-null-assertion': 'off'
  }
}
