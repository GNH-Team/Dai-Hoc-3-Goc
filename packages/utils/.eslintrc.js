module.exports = {
    extends: [require.resolve("@xstack/eslint/library")], // Installed in next step
    root: true, // Very important!
    parserOptions: {
        project: true
    }
    // Mẫu cấu hình overrides cho eslint
    // overrides: [
    //     {
    //         files: ["**/*.ts"], // param này là bắt buộc
    //         rules: {
    //             "no-console": "warn",
    //             "@typescript-eslint/no-unused-vars": "error",
    //             "simple-import-sort/imports": "warn",
    //             "simple-import-sort/exports": "warn",
    //             "import/extensions": [
    //                 "warn",
    //                 "ignorePackages",
    //                 {
    //                     "": "never"
    //                 }
    //             ],

    //             // Disable conflicting rules with prettier
    //             "@typescript-eslint/indent": "error",
    //             "@typescript-eslint/quotes": "error",
    //             "@typescript-eslint/semi": "warn"
    //         }
    //     }
    // ]
}
