<?php

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'
]);
Route::get('add-to-cart/{id}', [
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addtocart'
]);
Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('reduce/{id}',[
     'uses' => 'ProductController@getReduceByOne',
    'as' => 'product.getReduceByOne'
]);
Route::get('remove/{id}',[
     'uses' => 'ProductController@getReduceItem',
    'as' => 'product.getremoveItem'
]);

Route::group(['prefix' => 'user'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);
        Route::Post('/signup', [
            'uses' => 'UserController@postSignUp',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignIn',
            'as' => 'user.signin'
        ]);
        Route::Post('/signin', [
            'uses' => 'UserController@postSignIn',
            'as' => 'user.signin'
        ]);
    });
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [
            'uses' => 'UserController@profile',
            'as' => 'user.profile'
        ]);
        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
        Route::get('/checkout', [
            'uses' => 'ProductController@getCheckout',
            'as' => 'checkout'
        ]);
        Route::post('/checkout', [
            'uses' => 'ProductController@postCheckout',
            'as' => 'checkout'
        ]);
    });
});




