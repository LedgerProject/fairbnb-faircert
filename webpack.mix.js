const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'ledger_module/js/ledger.js')
mix.js(__dirname + '/Resources/assets/js/listing.js', 'ledger_module/js/listing.js')
mix.js(__dirname + '/Resources/assets/js/bootstrap.min.js', 'ledger_module/js/bootstrap.min.js')
mix.js(__dirname + '/Resources/assets/js/generate_keypair.js', 'ledger_module/js/generate_keypair.js')
    .postCss( __dirname + '/Resources/assets/css/ledger.css', 'ledger_module/css/ledger.css')
    .postCss( __dirname + '/Resources/assets/css/fairbnb_custom.css', 'ledger_module/css/fairbnb_custom.css')
    .postCss( __dirname + '/Resources/assets/css/bootstrap.css', 'ledger_module/css/bootstrap.css');

if (mix.inProduction()) {
    mix.version();
}
