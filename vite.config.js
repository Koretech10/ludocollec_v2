import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import path from "node:path";
import checker from "vite-plugin-checker";

export default defineConfig({
    resolve: {
        alias: [
            { find: '@', replacement: path.resolve(__dirname, 'assets') },
        ],
    },
    plugins: [
        symfonyPlugin({
            stimulus: '@/stimulus/controllers.json'
        }),
        checker({
            typescript: true,
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                app: "./assets/main.ts"
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
