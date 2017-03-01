<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');*/

Route::resource('/', 'IndexController', [
                                        'only' => ['index'],
                                        'names'=>['index'=>'home']
                                        ]);

Route::resource('portfolios', 'PortfolioController', [
                                                     'parameters' => [
                                                         'portfolios' => 'alias'
                                                        ]
                                                        ]);
Route::resource('articles', 'ArticlesController', [
                                                  'parameters' => [
                                                         'articles' => 'alias'
                                                    ]
                                                    ]);
Route::get('articles/cat/{cat_alias?}', ['uses' => 'ArticlesController@index','as'=>'articlesCat'])->where('cat_alias', '[\w-]+');

Route::resource('comment', 'CommentController', ['only' => ['store']]);

Route::match(['get', 'post'],'/contacts',['uses'=>'ContactsController@index', 'as'=>'contacts']);