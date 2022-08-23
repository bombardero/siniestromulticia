const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/map.js', 'public/js/map.js');
mix.styles('resources/css/app.css','public/css/estilos.css');
mix.styles('resources/css/somos-nosotros.css','public/css/somos-nosotros.css');
mix.styles('resources/css/garantias.css','public/css/garantias.css');
mix.styles('resources/css/legales.css','public/css/legales.css');
mix.styles('resources/css/preguntas-frecuentes.css','public/css/preguntas-frecuentes.css');
mix.styles('resources/css/contacto.css','public/css/contacto.css');
mix.styles('resources/css/login.css','public/css/login.css');
mix.styles('resources/css/precio-estimativo-alquileres.css','public/css/precio-estimativo-alquileres.css');
mix.styles('resources/css/estado-poliza.css','public/css/estado-poliza.css');
mix.styles('resources/css/formularios.css','public/css/formularios.css');
mix.styles('resources/css/sepelio.css','public/css/sepelio.css');
mix.styles('resources/css/siniestro.css', 'public/css/siniestro.css');