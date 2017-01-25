<?php

namespace Corp\Providers;

use Illuminate\Support\ServiceProvider;

use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // @set($i, 10) $i - аргумент, 10 - значение
        Blade::directive('set', function($exp){ //функция callback определяет функционал директивы set

            list($name, $val) = explode(',', $exp);  //list это @set($i, 10), explode - разбиваем строку по разделителю ,

            return "<?php $name = $val?>";

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
