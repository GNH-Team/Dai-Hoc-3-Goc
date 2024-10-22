const { resolve } = require("node:path")

const project = resolve(process.cwd(), "tsconfig.json")

module.exports = {
    extends: ["eslint-config-airbnb", "eslint-config-airbnb-typescript"].map(require.resolve),
    parserOptions: {
        sourceType: "module",
        ecmaVersion: "latest",
        project
    },
    plugins: [
        "simple-import-sort",
    ],
    // settings: {
    //     "import/resolver": {
    //         typescript: {
    //             project
    //         }
    //     }
    // },
    ignorePatterns: ["node_modules/", "dist/", ".eslintrc.cjs", "next.config.ts"],
    rules: {
        "no-console": "warn",
        "@typescript-eslint/no-unused-vars": "off",
        "simple-import-sort/imports": "warn",
        "simple-import-sort/exports": "warn",
        "comma-dangle": "off",
        "@typescript-eslint/comma-dangle": 'off',
        "import/extensions": [
            "warn",
            "ignorePackages",
            {
                "": "never",
                js: "never",
                jsx: "never",
                ts: "never",
                tsx: "never"
            }
        ],

        // Disable conflicting rules with prettier
        "@typescript-eslint/indent": ["warn", 4],
        "@typescript-eslint/quotes": ["warn", "double"],
        "@typescript-eslint/semi": ["warn", "never"],
        "react/react-in-jsx-scope": "off",
        "import/prefer-default-export": "off",
        "react/jsx-indent": "off",
        // "jsx-quotes": "off",
        "react/jsx-one-expression-per-line": "off",
        "react/jsx-indent-props": "off",
        "react/jsx-props-no-spreading": "off",
        "react/destructuring-assignment": "off",
        "max-len": ["warn", { "code": 130 }]
    },
    // ignores: ["node_modules/"]
}
