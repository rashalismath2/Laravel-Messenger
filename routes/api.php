<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware("auth:api")->group(function(){
    Route::get('/contacts',"ContactsController@get");
    Route::get('/messages/{contact}',"MessageController@get");
    Route::post('/messages',"MessageController@post");
});

