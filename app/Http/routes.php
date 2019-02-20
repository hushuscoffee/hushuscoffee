<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function(){
    return view('pages.welcome');
});
Route::resource('role', 'RoleController');
Route::resource('category', 'CategoryController');
Route::resource('shared', 'SharedController');
Route::resource('status', 'StatusController');

// Authentication Routes
Route::group(['namespace' => 'auth', 'prefix' => 'auth'], function () {
    Route::get('/login', 'LoginController@getLogin')->name('getLogin');
    Route::post('/login', 'LoginController@postLogin')->name('postLogin');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('getLogout');
    Route::get('/register', 'RegisterController@getRegister')->name('getRegister');
    Route::post('/register', 'RegisterController@postRegister')->name('postRegister');
});
// End of Authentication Routes

// Admin Routes
Route::group(['prefix' => 'admin'], function () {

});
// End of Admin Routes

// Notes Routes
Route::group(['prefix' => 'note'], function () {
    Route::get('/', 'NoteController@index')->name('note');
    Route::group(['prefix' => 'article'], function () {
        Route::get('create', 'ArticleController@create')->name('article.create');
        Route::post('create', 'ArticleController@store')->name('article.store');
        Route::get('all', 'NoteController@articleAll')->name('article.all');
        Route::get('events', 'NoteController@articleEvents')->name('article.events');
        Route::get('news', 'NoteController@articleNews')->name('article.news');
        Route::get('tips', 'NoteController@articleTips')->name('article.tips');
        
        Route::get('edit/{slug}', 'ArticleController@edit')->name('article.edit');
        Route::put('edit/{slug}', 'ArticleController@update')->name('article.update');
        Route::get('destroy', 'ArticleController@edit')->name('article.destroy');
    });
    Route::group(['prefix' => 'brewing'], function () {
    });
    Route::group(['prefix' => 'recipe'], function () {
    });
});
// End of Notes Routes

// Article Routes
Route::group(['prefix' => 'article'], function () {
    // Events routes
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', 'ArticleController@indexEvents')->name('events');
    });
    // End of Events routes

    // News Routes
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'ArticleController@indexNews')->name('news');
    });
    // End of News Routes
    
    // Tips Routes
    Route::group(['prefix' => 'tips'], function () {
        Route::get('/', 'ArticleController@indexTips')->name('tips');
    });
    Route::get('show/{slug}', 'NoteController@showArticle')->name('myArticle.show');
    // End of Tips Routes
});
// End of Article Routes

// Profile Routes
Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'ProfileController@profileIndex')->name('profile');
    Route::post('/', 'ProfileController@profileUpdate')->name('profile.update');

    Route::get('achievement', 'ProfileController@achievementIndex')->name('achievement');
    Route::post('achievement/create', 'ProfileController@achievementCreate')->name('achievement.create');
    Route::post('achievement/update', 'ProfileController@achievementUpdate')->name('achievement.update');
    Route::delete('achievement/{id}', 'ProfileController@achievementDestroy')->name('achievement.delete');

    Route::get('experience', 'ProfileController@experienceIndex')->name('experience');
    Route::post('experience/create', 'ProfileController@experienceCreate')->name('experience.create');
    Route::post('experience/update', 'ProfileController@experienceUpdate')->name('experience.update');
    Route::delete('experience/{id}', 'ProfileController@experienceDestroy')->name('experience.delete');

    Route::get('skill', 'ProfileController@skillIndex')->name('skill');
    Route::post('skill/create', 'ProfileController@skillCreate')->name('skill.create');
    Route::delete('skill/{id}', 'ProfileController@skillDestroy')->name('skill.delete');

    Route::get('language', 'ProfileController@languageIndex')->name('language');
    Route::post('language/create', 'ProfileController@languageCreate')->name('language.create');
    Route::delete('language/{id}', 'ProfileController@languageDestroy')->name('language.delete');

    Route::get('password', 'ProfileController@passwordIndex')->name('password');
    Route::post('password/change', 'ProfileController@passwordChange')->name('password.change');
});