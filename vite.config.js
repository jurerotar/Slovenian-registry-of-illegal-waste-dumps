import path from 'path';
import vue from '@vitejs/plugin-vue';
import {visualizer} from 'rollup-plugin-visualizer';

export default ({command}) => ({
    base: command === 'serve' ? '' : '/build/',
    publicDir: false,
    build: {
        manifest: true,
        outDir: 'public/build',
        target: 'esnext',
        sourcemap: true,
        rollupOptions: {
            external: [
                '/images/logo.svg'
            ],
            input: 'resources/js/app.ts',
            plugins: [
                visualizer({
                    filename: './storage/analyzer/bundle-analyzer.html',
                    open: true,
                    template: 'treemap', //sunburst, treemap, network.
                    json: false,
                    gzipSize: true,
                    brotliSize: true,
                }),
            ]
        }
    },
    resolve: {
        alias: [
            {
                find: '@',
                replacement: path.resolve('resources')
            },
        ]
    },
    plugins: [
        vue(),
    ],
    optimizeDeps: {
        include: [
            'vue',
            'vuex',
            'axios',
            '@inertiajs/inertia',
            '@inertiajs/inertia-vue3',
            '@inertiajs/progress',
            '@fortawesome/fontawesome-svg-core',
            '@fortawesome/free-brands-svg-icons',
            '@fortawesome/free-solid-svg-icons',
            '@fortawesome/free-regular-svg-icons',
            '@fortawesome/vue-fontawesome',
        ]
    }
});

