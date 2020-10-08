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


// -------------------------------------------------------- lfm

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// -------------------------------------------------------- index

Route::get('/404', [
    'uses' => 'Controller@getErrorNotFound',
    'as' => 'not-found-error'
]);

// -------------------------------------------------------- index

Route::get('/', [
    'uses' => 'Controller@getIndex',
    'as' => 'index'
]);

// -------------------------------------------------------- contact

Route::get('contact', [
    'uses' => 'Controller@getContact',
    'as' => 'contact'
]);

// -------------------------------------------------------- about

Route::get('about', [
    'uses' => 'Controller@getAbout',
    'as' => 'about'
]);


// -------------------------------------------------------- blog

Route::get('blog', [
    'uses' => 'Controller@getBlog',
    'as' => 'blog'
]);


// -------------------------------------------------------- donations

Route::group(['prefix' => 'donation'], function () {

    Route::get('/options', [
        'uses' => 'DonationController@getOptions',
        'as' => 'donate'
    ]);

    Route::get('/continue', [
        'uses' => 'DonationController@getContinue',
        'as' => 'donate-continue'
    ]);

    Route::post('/complete', [
        'uses' => 'DonationController@postDonation',
        'as' => 'donate-complete'
    ]);

    Route::get('/success', [
        'uses' => 'DonationController@getSuccess',
        'as' => 'donate-success'
    ]);
});


// -------------------------------------------------------- kennel
Route::group(['prefix' => 'kennel'], function () {

    Route::get('/adoptable', [
        'uses' => 'PetController@getAllPets',
        'as' => 'adoptable'
    ]);

    Route::get('/available', [
        'uses' => 'PetController@getAvailable',
        'as' => 'available'
    ]);

    Route::get('/adoptable-dogs', [
        'uses' => 'PetController@getDogs',
        'as' => 'dogs'
    ]);

    Route::get('/adoptable-cats', [
        'uses' => 'PetController@getCats',
        'as' => 'cats'
    ]);

    Route::get('/details/{id}', [
        'uses' => 'PetController@getPetDetails',
        'as' => 'pet-details'
    ]);

    Route::get('/add', [
        'uses' => 'PetController@getAddPet',
        'as' => 'add-pet'
    ]);

    Route::post('/adoptable', [
        'uses' => 'PetController@postAddPet',
        'as' => 'add-pet-post'
    ]);

    Route::post('/adoptable/{id}', [
        'uses' => 'PetController@postDeletePet',
        'as' => 'delete-pet'
    ]);

    Route::get('/adoptable/update/{id}', [
        'uses' => 'PetController@getUpdatePet',
        'as' => 'update-pet'
    ]);

    Route::post('/adoptable/update/{id}', [
        'uses' => 'PetController@postUpdatePet',
        'as' => 'post-update-pet'
    ]);

    Route::any('/results', [
        'uses' => 'PetController@search',
        'as' => 'pet-search'
    ]);

    Route::any('/refine', [
        'uses' => 'PetController@refineSearch',
        'as' => 'refine-pet-search'
    ]);

});

// -------------------------------------------------------- adoptions

Route::group(['prefix' => 'adopt'], function () {

    Route::get('/form', [
        'uses' => 'AdoptionController@getForm',
        'as' => 'adopt-form'
    ]);

    Route::post('/form', [
        'uses' => 'AdoptionController@postForm',
        'as' => 'adopt-form-post'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'AdoptionController@getEditAdoptForm',
        'as' => 'adopt-form-edit'
    ]);

    Route::post('/edit', [
        'uses' => 'AdoptionController@postAdoptFormEdit',
        'as' => 'post-adopt-form-edit'
    ]);

    Route::get('/apply/{name}', [
        'uses' => 'AdoptionController@getApplyAdoptForm',
        'as' => 'get-apply'
    ]);

    Route::get('/success', [
        'uses' => 'AdoptionController@getSuccess',
        'as' => 'get-success'
    ]);
});

// -------------------------------------------------------- foster

Route::group(['prefix' => 'foster'], function () {

    Route::get('/info', [
        'uses' => 'AdoptionController@getFosterInfo',
        'as' => 'foster-info'
    ]);

    Route::get('/form', [
        'uses' => 'AdoptionController@getFosterForm',
        'as' => 'foster-form'
    ]);

    Route::post('/form', [
        'uses' => 'AdoptionController@postFosterForm',
        'as' => 'foster-form-post'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'AdoptionController@getEditFosterForm',
        'as' => 'foster-form-edit'
    ]);

    Route::post('/edit', [
        'uses' => 'AdoptionController@postFosterFormEdit',
        'as' => 'post-foster-form-edit'
    ]);

});

// ------------------------------------------------------ user

Route::group(['prefix' => 'user'], function () {
    Route::get('/sign-up', [
        'uses' => 'UserController@getSignUp',
        'as' => 'sign-up'
    ]);
    Route::post('/sign-up', [
        'uses' => 'UserController@postSignUp',
        'as' => 'sign-up-post'
    ]);

    Route::get('/sign-in', [
        'uses' => 'UserController@getSignIn',
        'as' => 'login'
    ]);

    Route::post('/sign-in', [
        'uses' => 'UserController@postSignIn',
        'as' => 'sign-in-post'
    ]);

    Route::post('/sign-out', [
        'uses' => 'UserController@postSignOut',
        'as' => 'sign-out'
    ]);

    Route::get('/profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'profile'
    ]);

    Route::get('/update', [
        'uses' => 'UserController@getUpdateProfile',
        'as' => 'update-profile'
    ]);

    Route::post('/updated', [
        'uses' => 'UserController@putUpdateProfile',
        'as' => 'update-profile-post'
    ]);

    Route::any('/password-reset', [
        'uses' => 'UserController@postChangePassword',
        'as' => 'change-password'
    ]);

    // message threads
    Route::get('/inbox', [
        'uses' => 'AlertController@getInbox',
        'as' => 'inbox'
    ]);

    Route::get('/thread/{id}', [
        'uses' => 'AlertController@getThread',
        'as' => 'get-message'
    ]);

    Route::post('/thread', [
        'uses' => 'AlertController@postReply',
        'as' => 'message-reply'
    ]);

    Route::post('/delete-thread', [
        'uses' => 'AlertController@postReply',
        'as' => 'delete-thread'
    ]);

    Route::post('/messages',[
        'uses' => 'AlertController@sendMessage',
        'as' => 'send-message'
    ]);

    Route::post('/contact-us',[
        'uses' => 'AlertController@sendContactMessage',
        'as' => 'send-contact-message'
    ]);

    Route::post('/report',[
        'uses' => 'AlertController@sendReport',
        'as' => 'send-report'
    ]);

    Route::post('/report-user',[
        'uses' => 'AlertController@sendUserReport',
        'as' => 'report-user'
    ]);

    Route::get('/notifications',[
        'uses' => 'AlertController@getNotifications',
        'as' => 'notifications'
    ]);

    Route::get('/moderated',[
        'uses' => 'UserController@getModeratedForums',
        'as' => 'moderated'
    ]);

    Route::get('/preferences',[
        'uses' => 'UserController@getPreferences',
        'as' => 'preferences'
    ]);

    Route::get('/donations',[
        'uses' => 'DonationController@getDonations',
        'as' => 'donations'
    ]);

    Route::post('/cancel-donation',[
        'uses' => 'DonationController@cancelDonationSubscription',
        'as' => 'cancel-donation'
    ]);

});
// Still user related, don't want the user group name
Route::get('/profile/{username}', [
    'uses' => 'UserController@getPublicProfile',
    'as' => 'public-profile'
]);
// -------------------------------------------------------- posts/forum

Route::group(['prefix' => 'forum'], function () {

    Route::get('/all', [
        'uses' => 'PostController@getPosts',
        'as' => 'posts'
    ]);

    Route::get('', [
        'uses' => 'PostController@getPosts',
        'as' => 'posts'
    ]);

    Route::get('/details/{id}', [
        'uses' => 'PostController@getPostDetails',
        'as' => 'forum-details'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'PostController@getEditPost',
        'as' => 'edit-post'
    ]);

    Route::post('/edit/{id}', [
        'uses' => 'PostController@putEditPost',
        'as' => 'put-edit-post'
    ]);


    Route::any('/delete', [
        'uses' => 'PostController@deletePost',
        'as' => 'delete-post'
    ]);

    Route::get('/new', [
        'uses' => 'PostController@getAddPost',
        'as' => 'post-new'
    ]);

    Route::post('/success', [
        'uses' => 'PostController@postAddPost',
        'as' => 'post-add-post'
    ]);

    Route::any('/results', [
        'uses' => 'PostController@search',
        'as' => 'search'
    ]);

    Route::any('/my-posts', [
        'uses' => 'PostController@getMyPosts',
        'as' => 'my-posts'
    ]);

    Route::any('/posts/user/{id}', [
        'uses' => 'PostController@getUserPosts',
        'as' => 'user-posts'
    ]);


//    categories

    Route::get('/seeking', [
        'uses' => 'PostController@getSeeking',
        'as' => 'seeking'
    ]);
    Route::get('/found', [
        'uses' => 'PostController@getFound',
        'as' => 'found'
    ]);
    Route::get('/lost', [
        'uses' => 'PostController@getLost',
        'as' => 'lost'
    ]);
    Route::get('/general', [
        'uses' => 'PostController@getGeneral',
        'as' => 'general'
    ]);

//    comments & replies

});

Route::group(['prefix' => 'comment'], function () {

    Route::any('/delete', [
        'uses' => 'PostController@deleteComment',
        'as' => 'delete-comment'
    ]);

    Route::post('/new', [
        'uses' => 'PostController@postComment',
        'as' => 'post-comment'
    ]);

    Route::post('/reply', [
        'uses' => 'PostController@postReply',
        'as' => 'post-reply'
    ]);

});

// -------------------------------------------------------- map

Route::group(['prefix' => 'map'], function () {

    Route::any('/', [
        'uses' => 'PostController@getMap',
        'as' => 'map'
    ]);

    Route::get('/lost', [
        'uses' => 'PostController@getLostMap',
        'as' => 'lost-map'
    ]);

    Route::get('/found', [
        'uses' => 'PostController@getFoundMap',
        'as' => 'found-map'
    ]);

    Route::get('/seeking', [
        'uses' => 'PostController@getSeekingMap',
        'as' => 'seeking-map'
    ]);

    Route::get('/{id}', [
        'uses' => 'PostController@getSpecificMap',
        'as' => 'map-specific'
    ]);

});


// -------------------------------------------------------- alerts

Route::group(['prefix' => 'message'], function () {

    Route::post('/delete-sent',[
        'uses' => 'AlertController@deleteSentMessages',
        'as' => 'delete-sent'
    ]);

    Route::post('/delete-received',[
        'uses' => 'AlertController@deleteReceivedMessages',
        'as' => 'delete-received'
    ]);

    Route::post('/delete-message',[
        'uses' => 'AlertController@markMessageDeleted',
        'as' => 'delete-message'
    ]);

    Route::post('/delete-thread',[
        'uses' => 'AlertController@markThreadDeleted',
        'as' => 'delete-thread'
    ]);
});

// -------------------------------------------------------- alerts

Route::group(['prefix' => 'alert', 'middleware' => ['read']], function () {

    Route::get('/new', [
        'uses' => 'AlertController@getNewAlert',
        'as' => 'create-alert'
    ]);

    Route::post('/new', [
        'uses' => 'AlertController@postNewAlert',
        'as' => 'post-create-alert'
    ]);

    Route::any('/delete', [
        'uses' => 'AlertController@deleteAlert',
        'as' => 'delete-alert'
    ]);

    Route::post('/update', [
        'uses' => 'AlertController@updateAlert',
        'as' => 'update-alert'
    ]);

    Route::post('/mark-read',[
        'uses' => 'AlertController@markReadNotifications',
        'as' => 'mark-read'
    ]);

    Route::post('/notification/mark-read',[
        'uses' => 'AlertController@markReadFromNotification',
        'as' => 'from-notification'
    ]);

    Route::get('/mark-read-link/{read}',[
        'uses' => 'AlertController@markReadFromLink',
        'as' => 'read-from-link'
    ]);

});

