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

Route::get('/', 'PagesController@getIndex')->name('index');
Route::get('contact', 'PagesController@getContact');
Route::get('about', 'PagesController@getAbout');
Route::resource('articles', 'ArticleController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
Route::get('create-recipe', 'PersonalizeController@recipe')->name('personalize.recipe');
Route::post('create-recipe', 'PersonalizeController@storeRecipe')->name('personalize.recipe-create');
Route::get('create-brewing', 'PersonalizeController@brewing')->name('personalize.brewing');
Route::post('create-brewing', 'PersonalizeController@storeBrewing')->name('personalize.brewing-create');
Route::get('articles/show/{slug}', 'ArticleController@show')->name('articles.show');
Route::get('/edit/{slug}', 'ArticleController@edit')->name('articles.edit');
Route::get('/search', 'PagesController@search')->name('search');
Route::post('comment/{article_id}', 'CommentController@store')->name('comment.store');
Route::post('update-brewing', 'PersonalizeController@updateBrewing')->name('personalize.brewing-update');
Route::delete('/comment/delete/{comment}', 'CommentController@destroy')->name('comment.delete');
Route::get('share/{id}', 'ArticleController@share')->name('article.share');
Route::get('unshare/{id}', 'ArticleController@unshare')->name('article.unshare');

Route::group(['prefix' => 'favorite'], function () {
    Route::get('/', 'FavouriteController@index')->name('favorite.index');
    Route::get('add/{article_id}', 'FavouriteController@add')->name('favorite.add');
    Route::get('remove/{id}', 'FavouriteController@remove')->name('favorite.remove');
});

//Auth::routes();

//Routing untuk authentikasi
Route::group(['namespace' => 'auth', 'prefix' => 'auth'], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/register', 'RegisterController@store')->name('register');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@user')->name('admin');
    Route::get('/user', 'AdminController@user')->name('user');
    Route::get('/activate/{id}', 'AdminController@activate')->name('admin.activate');
    Route::get('/deactivate/{id}', 'AdminController@deactivate')->name('admin.deactivate');
    Route::get('/delete/{id}', 'AdminController@delete')->name('admin.delete');

});

Route::group(['prefix' => 'personalize'], function () {
    Route::get('/', 'PersonalizeController@index')->name('personalize');

    Route::get('/create', 'PersonalizeController@create')->name('personalize.create');
    Route::get('/edit/{personalize}', 'PersonalizeController@edit')->name('personalize.edit');
    Route::put('/update/{personalize}', 'PersonalizeController@update')->name('personalize.update');

    Route::delete('/delete/{personalize}', 'PersonalizeController@destroy')->name('personalize.delete');
    Route::get('/myrecipe', 'PersonalizeController@myRecipe')->name('personalize.myrecipe');
    Route::get('/myrecipe/{slug}', 'PersonalizeController@showRecipe')->name('personalize.showrecipe');
    Route::get('/mybrewing', 'PersonalizeController@myBrewing')->name('personalize.mybrewing');
    Route::get('/mybrewing/{slug}', 'PersonalizeController@showBrewing')->name('personalize.showbrewing');
    Route::get('/mybrewing/edit/{slug}', 'PersonalizeController@editBrewing')->name('personalize.editbrewing');
    Route::delete('/delete-brewing/{id}', 'PersonalizeController@destroyBrewing')->name('personalize.destroybrewing');
    Route::get('/myarticle', 'PersonalizeController@myArticle')->name('personalize.myarticle');
    Route::get('/myarticle/{slug}', 'PersonalizeController@showArticle')->name('personalize.showarticle');

    Route::get('/mytechnique', 'PersonalizeController@myTechnique')->name('personalize.mytechnique');
    Route::get('/mytechnique/{personalize}', 'PersonalizeController@showTechnique')->name('personalize.showtechnique');
});

Route::group(['prefix' => 'recipe'], function () {
    Route::get('/', 'ArticleController@recipe')->name('recipe');
    Route::get('/{slug}', 'ArticleController@recipeShow')->name('recipe.show');
});
Route::group(['prefix' => 'brewing'], function () {
    Route::get('/', 'ArticleController@brewing')->name('brewing');
    Route::get('/{slug}', 'ArticleController@brewingShow')->name('brewing.show');
});

Route::group(['prefix' => 'story'], function () {
    Route::get('/', 'ArticleController@story')->name('story');
    Route::get('/{slug}', 'ArticleController@storyShow')->name('story.show');
});
Route::group(['prefix' => 'tips'], function () {
    Route::get('/', 'ArticleController@tips')->name('tips');
    Route::get('/{slug}', 'ArticleController@tipsShow')->name('tips.show');
});
Route::group(['prefix' => 'info'], function () {
    Route::get('/', 'ArticleController@info')->name('info');
    Route::get('/{slug}', 'ArticleController@infoShow')->name('info.show');
});
Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'ArticleController@news')->name('news');
    Route::get('/{slug}', 'ArticleController@newsShow')->name('news.show');
});
Route::group(['prefix' => 'trend'], function () {
    Route::get('/', 'ArticleController@story')->name('trend');
    Route::get('/{slug}', 'ArticleController@trendShow')->name('trend.show');
});
Route::group(['prefix' => 'people'], function () {
    Route::get('/', 'UserController@people')->name('people');
    Route::get('/view/{slug}', 'UserController@peopleShow')->name('people.show');
});
Route::group(['prefix' => 'event'], function () {
    Route::get('/', 'ArticleController@event')->name('event');
    Route::get('/{slug}', 'ArticleController@eventShow')->name('event.show');
});

Route::group(['prefix' => 'roles'], function () {
    Route::get('/index', 'RoleController@index')->name('roles.index');
    Route::get('/create', 'RoleController@create')->name('roles.create');
    Route::get('/edit/{role}', 'RoleController@edit')->name('roles.edit');
    Route::put('/update/{role}', 'RoleController@update')->name('roles.update');
    Route::post('/roles', 'RoleController@store')->name('roles.store');
    Route::delete('/delete/{role}', 'RoleController@destroy')->name('roles.delete');
});

// Route::group(['prefix' => 'articles'], function() {
//     Route::get('/index', 'ArticleController@index')->name('articles.index');
//     Route::get('/create', 'ArticleController@create')->name('articles.create');
//     Route::get('/edit/{article}', 'ArticleController@edit')->name('articles.edit');
//     Route::put('/articles/update/{article}', 'ArticleController@update')->name('articles.update');
//     Route::post('/articles', 'ArticleController@store')->name('articles.store');
//     Route::delete('/delete/{article}', 'ArticleController@destroy')->name('articles.delete');
// });

Route::group(['prefix' => 'article-image'], function () {
    Route::get('/index', 'ArticleImageController@index')->name('article-image.index');
    Route::get('/article-image/create', 'ArticleImageController@create')->name('article-image.create');
    Route::get('/article-image/edit/{article}', 'ArticleImageController@edit')->name('article-image.edit');
    Route::put('/article-image/update/{article}', 'ArticleImageController@update')->name('article-image.update');
    Route::post('/article-image', 'ArticleImageController@store')->name('article-image.store');
    Route::delete('/article-image/delete/{article}', 'ArticleImageController@destroy')->name('article-image.delete');
});

Route::group(['prefix' => 'article-report'], function () {
    Route::get('/index', 'ArticleController@index')->name('article-report.index');
    Route::get('/article-report/create', 'ArticleController@create')->name('article-report.create');
    Route::get('/article-report/edit/{article}', 'ArticleController@edit')->name('article-report.edit');
    Route::put('/article-report/update/{article}', 'ArticleController@update')->name('article-report.update');
    Route::post('/article-report', 'ArticleController@store')->name('article-report.store');
    Route::delete('/article-report/delete/{article}', 'ArticleController@destroy')->name('article-report.delete');
});

Route::group(['prefix' => 'comment-report'], function () {
    Route::get('/index', 'CommentReportController@index')->name('comment-report.index');
    Route::get('/comment-report/create', 'CommentReportController@create')->name('comment-report.create');
    Route::get('/comment-report/edit/{comment}', 'CommentReportController@edit')->name('comment-report.edit');
    Route::put('/comment-report/update/{comment}', 'CommentReportController@update')->name('comment-report.update');
    Route::post('/comment-report', 'CommentReportController@store')->name('comment-report.store');
    Route::delete('/comment-report/delete/{comment}', 'CommentReportController@destroy')->name('comment-report.delete');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/index', 'CommentController@index')->name('comments.index');
    Route::get('/comments/create', 'CommentController@create')->name('comments.create');
    Route::get('/comments/edit/{comment}', 'CommentController@edit')->name('comments.edit');
    Route::put('/comments/update/{comment}', 'CommentController@update')->name('comments.update');
    Route::post('/comments', 'CommentController@store')->name('comments.store');
    Route::delete('/comments/delete/{comment}', 'CommentController@destroy')->name('comments.delete');
});

Route::group(['prefix' => 'votes'], function () {
    Route::get('/index', 'VoteController@index')->name('votes.index');
    Route::get('/create', 'VoteController@create')->name('votes.create');
    Route::get('/edit/{vote}', 'VoteController@edit')->name('votes.edit');
    Route::put('/update/{vote}', 'VoteController@update')->name('votes.update');
    Route::post('/votes', 'VoteController@store')->name('votes.store');
    Route::delete('/delete/{vote}', 'VoteController@destroy')->name('votes.delete');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/index', 'UserController@index')->name('users.index');
    Route::get('/create', 'UserController@create')->name('users.create');
    Route::get('/edit/{user}', 'UserController@edit')->name('users.edit');
    Route::put('/update/{user}', 'UserController@update')->name('users.update');
    Route::post('/users', 'UserController@store')->name('users.store');
    Route::delete('/delete/{user}', 'UserController@destroy')->name('users.delete');

    Route::get('/profile/basic', 'UserController@profileBasic')->name('profile.basic');
    Route::post('/profile/basic/', 'UserController@profileBasicUpdate')->name('profile.basic.update');
    Route::get('/professional/profile', 'UserController@proProfile')->name('professional.profile');
    Route::post('/professional/profile', 'UserController@proProfileUpdate')->name('professional.profile.update');
    Route::get('/professional/accomplishments', 'UserController@proAccomplishments')->name('professional.accomplishments');
    Route::post('/professional/achievement', 'UserController@proAchievementAdd')->name('professional.achievement.add');
    Route::get('/professional/experience', 'UserController@proExperience')->name('professional.experience');
    Route::post('/professional/experience', 'UserController@proExperienceAdd')->name('professional.experience.add');
    Route::get('/professional/skill', 'UserController@proSkill')->name('professional.skill');
    Route::post('/professional/skill', 'UserController@proSkillAdd')->name('professional.skill.add');
    Route::post('/professional/language', 'UserController@proLanguageAdd')->name('professional.language.add');
    Route::get('/avatar/change', 'UserController@avatarChange')->name('avatar.change');
    Route::post('/avatar/change', 'UserController@avatarChangeUpdate')->name('avatar.change.update');

    Route::get('/password/change', 'UserController@passwordChange')->name('password.change');
    Route::post('/password/change', 'UserController@passwordChangeUpdate')->name('password.change.update');
});

Route::group(['prefix' => 'jobs'], function () {
    Route::get('/index', 'JobController@index')->name('jobs.index');
    Route::get('/create', 'JobController@create')->name('jobs.create');
    Route::get('/edit/{job}', 'JobController@edit')->name('jobs.edit');
    Route::put('/update/{job}', 'JobController@update')->name('jobs.update');
    Route::post('/jobs', 'JobController@store')->name('jobs.store');
    Route::delete('/delete/{job}', 'JobController@destroy')->name('jobs.delete');
});

Route::group(['prefix' => 'groups'], function () {
    Route::get('/index', 'GroupController@index')->name('groups.index');
    Route::get('/create', 'GroupController@create')->name('groups.create');
    Route::get('/edit/{group}', 'GroupController@edit')->name('groups.edit');
    Route::put('/update/{group}', 'GroupController@update')->name('groups.update');
    Route::post('/groups', 'GroupController@store')->name('groups.store');
    Route::delete('/delete/{group}', 'GroupController@destroy')->name('groups.delete');
});

Route::group(['prefix' => 'master-status'], function () {
    Route::get('/index', 'MasterStatusController@index')->name('status.index');
    Route::get('/create', 'MasterStatusController@create')->name('status.create');
    Route::get('/edit/{status}', 'MasterStatusController@edit')->name('status.edit');
    Route::put('/update/{status}', 'MasterStatusController@update')->name('status.update');
    Route::post('/status', 'MasterStatusController@store')->name('status.store');
    Route::delete('/delete/{status}', 'MasterStatusController@destroy')->name('status.delete');
});

Route::group(['prefix' => 'master-shared'], function () {
    Route::get('/index', 'MasterSharedController@index')->name('shared.index');
    Route::get('/create', 'MasterSharedController@create')->name('shared.create');
    Route::get('/edit/{shared}', 'MasterSharedController@edit')->name('shared.edit');
    Route::put('/update/{shared}', 'MasterSharedController@update')->name('shared.update');
    Route::post('/shared', 'MasterSharedController@store')->name('shared.store');
    Route::delete('/delete/{shared}', 'MasterSharedController@destroy')->name('shared.delete');
});

Route::group(['prefix' => 'master-category'], function () {
    Route::get('/index', 'MasterCategoryController@index')->name('category.index');
    Route::get('/create', 'MasterCategoryController@create')->name('category.create');
    Route::get('/edit/{category}', 'MasterCategoryController@edit')->name('category.edit');
    Route::put('/update/{category}', 'MasterCategoryController@update')->name('category.update');
    Route::post('/category', 'MasterCategoryController@store')->name('category.store');
    Route::delete('/delete/{category}', 'MasterCategoryController@destroy')->name('category.delete');
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('/index', 'TagController@index')->name('tag.index');
    Route::get('/create', 'TagController@create')->name('tag.create');
    Route::get('/edit/{tag}', 'TagController@edit')->name('tag.edit');
    Route::put('/update/{tag}', 'TagController@update')->name('tag.update');
    Route::post('/tags', 'TagController@store')->name('tag.store');
    Route::delete('/delete/{tag}', 'TagController@destroy')->name('tag.delete');
});

Route::group(['prefix' => 'subcategorys'], function () {
    Route::get('/index', 'SubcategoryController@index')->name('subcategory.index');
    Route::get('/create', 'SubcategoryController@create')->name('subcategory.create');
    Route::get('/edit/{sub}', 'SubcategoryController@edit')->name('subcategory.edit');
    Route::put('/update/{sub}', 'SubcategoryController@update')->name('subcategory.update');
    Route::post('/subcategorys', 'SubcategoryController@store')->name('subcategory.store');
    Route::delete('/delete/{sub}', 'SubcategoryController@destroy')->name('subcategory.delete');
});

//Comments
Route::post('comments/{id_comment_parents}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
