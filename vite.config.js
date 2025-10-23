import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    root: 'assets',
    build: {
        outDir: 'dist',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                admin: path.resolve(__dirname, 'assets/js/admin.js'),
            },
            output: {
                entryFileNames: 'admin.js',
                assetFileNames: 'admin.css',
            },
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: '',
            },
        },
    },
});
