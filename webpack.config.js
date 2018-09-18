var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/assets/')
    
    // the public path used by the web server to access the previous directory
    .setPublicPath('/assets')

    // will create public/assets/app.js and public/assets/app.css
    .addEntry('app', './assets/js/app.js')
    
    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()

    // allow sass/scss files to be processed
     .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
