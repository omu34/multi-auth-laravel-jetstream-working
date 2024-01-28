const mix = require('laravel-mix');
const LaravelVitePlugin = require('laravel-vite-plugin');
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/styles.css', 'public/assets/css', [require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])

.copyDirectory('resources/fonts', 'public/fonts')
    .webpackConfig({
        plugins: [
            new LaravelVitePlugin({
                dev: !mix.inProduction(),
            }),
        ],
    });

if (mix.inProduction()) {
    mix.version();
}
