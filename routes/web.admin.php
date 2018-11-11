<?php

Route::group([
    'as' => 'app',
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin']
], function() {

    Route::get('/', 'HomeController@index');

});
