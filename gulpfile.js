var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.sass('app.sass')
        .browserify('userhome.js')
        .browserify('uservehicle.js')
        .browserSync({
            notify: false
        });
});
