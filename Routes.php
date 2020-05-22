<?php
    return [
        App\Core\Route::get('|^user/register/?$|', 'Main', 'getRegister'),
        App\Core\Route::post('|^user/register/?$|', 'Main', 'postRegister'),
        App\Core\Route::get('|^registration/?$|', 'Main', 'getLoginRegister'),
        App\Core\Route::post('|^registration/?$|', 'Main', 'postLogin'),

        App\Core\Route::get('|^user/logout/?$|', 'Main', 'getLogout'),

        #App\Core\Route::get('|^user/login/?$|', 'Main', 'getLogin'),
        #App\Core\Route::post('|^user/login/?$|', 'Main', 'postLogin'),        

        App\Core\Route::get('|^category/([0-9]+)/?$|', 'Category', 'show'),

        App\Core\Route::get('|^event/([0-9]+)/?$|', 'Event', 'show'),

        App\Core\Route::post('|^search/?$|', 'Event', 'postSearch'),

        #Find Event
        App\Core\Route::get('|^find/?$|', 'FindEvent', 'getFindEvent'),
        App\Core\Route::post('|^findevents/?$|', 'FindEvent', 'postFindEventCity'),
        #App\Core\Route::post('|^findevents/?$|', 'FindEvent', 'postFindEventDate'),

        # Calendar Route:
        App\Core\Route::get('|^calendar/?$|', 'Calendar', 'calendar'),

        #Login-Register
        App\Core\Route::get('|^registration/?$|', 'Main', 'getLoginRegister'),

        #Contact
        App\Core\Route::get('|^user/contact/?$|', 'Contact', 'getContact'),
        App\Core\Route::post('|^user/contact/?$|', 'Contact', 'postContact'),


        #Api Routes:
        App\Core\Route::get('|^api/bookmarks/?$|', 'ApiBookmark', 'getBookmarks'),
        App\Core\Route::get('|^api/bookmarks/add/([0-9]+)/?$|', 'ApiBookmark', 'addBookmark'),
        App\Core\Route::get('|^api/bookmarks/clear/?$|', 'ApiBookmark', 'clear'),

        # User Role Route:
        App\Core\Route::get('|^user/profile/?$|', 'UserDashboard', 'index'),
        App\Core\Route::get('|^user/categories/?$|', 'UserCategoryManagement', 'categories'),
        App\Core\Route::get('|^user/categories/edit/([0-9]+)/?$|', 'UserCategoryManagement', 'getEdit'),
        App\Core\Route::post('|^user/categories/edit/([0-9]+)/?$|', 'UserCategoryManagement', 'postEdit'),
        App\Core\Route::get('|^user/categories/add/?$|', 'UserCategoryManagement', 'getAdd'),
        App\Core\Route::post('|^user/categories/add/?$|', 'UserCategoryManagement', 'postAdd'),

        
        App\Core\Route::get('|^user/events/?$|', 'UserEventManagement', 'events'),
        App\Core\Route::get('|^user/events/edit/([0-9]+)/?$|', 'UserEventManagement', 'getEdit'),
        App\Core\Route::post('|^user/events/edit/([0-9]+)/?$|', 'UserEventManagement', 'postEdit'),
        App\Core\Route::get('|^user/events/add/?$|', 'UserEventManagement', 'getAdd'),
        App\Core\Route::post('|^user/events/add/?$|', 'UserEventManagement', 'postAdd'),

        # Home Route:
        #App\Core\Route::any('|^.*$|', 'Main', 'home')
        App\Core\Route::any('|^home/?$|', 'Main', 'home')

    ];