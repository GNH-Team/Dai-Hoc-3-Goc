const { resolve } = require("node:path")

const project = resolve(process.cwd(), "tsconfig.json")

module.exports = {
    extends: ["eslint-config-airbnb-base", "eslint-config-airbnb-typescript/base"].map(require.resolve),
    parserOptions: {
        sourceType: "module",
        ecmaVersion: "latest",
        project
    },
    plugins: ["simple-import-sort"],
    // settings: {
    //     "import/resolver": {
    //         typescript: {
    //             project
    //         }
    //     }
    // },
    ignorePatterns: ["node_modules/", "dist/", ".eslintrc.cjs", "nuxt.config.ts"],
    rules: {
        "no-console": "warn",
        "@typescript-eslint/no-unused-vars": "off",
        "simple-import-sort/imports": "warn",
        "simple-import-sort/exports": "warn",
        "comma-dangle": "off",
        "@typescript-eslint/comma-dangle": "off",
        "import/extensions": [
            "warn",
            "ignorePackages",
            {
                "": "never"
            }
        ],

        // Disable conflicting rules with prettier
        "@typescript-eslint/indent": "off",
        "@typescript-eslint/quotes": "off",
        "@typescript-eslint/semi": "off"
    }
}
