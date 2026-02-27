import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import path from "node:path";

export default defineConfig({
    resolve: {
        alias: [
            { find: '@', replacement: path.resolve(__dirname, 'assets') },
        ],
    },
    plugins: [
        symfonyPlugin(),
    ],
    build: {
        rollupOptions: {
            input: {
                app: "./assets/main.js"
            },
        }
    },
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true,
                silenceDeprecations: [
                    'import',
                ],
            },
        },
    },
});
