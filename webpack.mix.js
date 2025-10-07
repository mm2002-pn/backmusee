const mix = require("laravel-mix");
const options = require("./package.json").options;
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
  Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.|
 |
 */

mix
  .js("resources/js/Controller/controller.js", "public/js/Controller")
  .js("resources/js/Controller/SidebarCtrl.js", "public/js/Controller")
  .sass("resources/sass/app.scss", "public/css")
  .copyDirectory("resources/js", "public/js")
  .copyDirectory("resources/css", "public/css")
  .copyDirectory("resources/assets", "public/assets")
  .copyDirectory("resources/images", "public/images")
  .browserSync({
    proxy: "http://localhost/" + options.links.dev,
    port: options.port + 1,
    files: [
      "resources/**/*.*", // Watch all resource files
      "public/**/*.*", // Watch public folder for versioned files
      "resources/views/**/*.php", // Watch blade files
    ],
  });
  

if (mix.inProduction()) {
  mix.version();
} else {
  mix.browserSync({
    proxy: "http://localhost/" + options.links.dev,
    port: options.port + 1,
    files: [
      "resources/js/**/*.js",
      "resources/css/**/*.css",
      "resources/views/**/*.php",
      "public/**/*.*",
    ],
  });
}

// gestion cache
mix.webpackConfig({
  output: {
    chunkFilename: "js/[name].[chunkhash].js",
  },
  cache: false, // Disable webpack caching
});
