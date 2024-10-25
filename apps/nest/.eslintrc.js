// module.exports = {
//   parser: '@typescript-eslint/parser',
//   parserOptions: {
//     project: 'tsconfig.json',
//     tsconfigRootDir: __dirname,
//     sourceType: 'module',
//   },
//   plugins: ['@typescript-eslint/eslint-plugin'],
//   extends: [
//     'plugin:@typescript-eslint/recommended',
//     'plugin:prettier/recommended',
//   ],
//   root: true,
//   env: {
//     node: true,
//     jest: true,
//   },
//   ignorePatterns: ['.eslintrc.js'],
//   rules: {
//     '@typescript-eslint/interface-name-prefix': 'off',
//     '@typescript-eslint/explicit-function-return-type': 'off',
//     '@typescript-eslint/explicit-module-boundary-types': 'off',
//     '@typescript-eslint/no-explicit-any': 'off',
//   },
// };

module.exports = {
  extends: [require.resolve("@xstack/eslint/next")], // Installed in next step
  root: true, // Very important!
  parserOptions: {
      project: true
  },
  rules: {
      "linebreak-style": "warn",
      "max-len": "off"
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
