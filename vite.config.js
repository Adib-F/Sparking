import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

function moveManifestPlugin() {
    return {
        name: 'move-manifest-plugin',
        closeBundle: () => {
            const src = path.resolve('public/build/.vite/manifest.json');
            const dest = path.resolve('public/build/manifest.json');
            if (fs.existsSync(src)) {
                fs.copyFileSync(src, dest);
                console.log('✅ manifest.json dipindahkan ke public/build/');
            } else {
                console.warn('❌ manifest.json tidak ditemukan!');
            }
        }
    };
}

export default defineConfig({
    base: '/build/', // ✅ tambahkan ini
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        moveManifestPlugin()
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        emptyOutDir: true,
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
            }
        }
    },
});
