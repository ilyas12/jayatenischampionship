<?php

/**
 * BACKEND ROUTES
 **/
$router->group([
    'namespace' => 'Admin\Controllers',
    'prefix'    => '_d50d0608e7c3270b3f0e3753f996387b'
], function ($router) {
    Route::any('/', function () {
        return Redirect::to('_d50d0608e7c3270b3f0e3753f996387b/login');
    });
    Route::get('/logout', array('as' => 'admin_logout', 'uses' => 'Login@do_logout'));
    Route::any('/login/dologin', array('as' => 'admin_login_process', 'uses' => 'Login@do_login'));
    Route::get('/login', array('as' => 'admin_login', 'uses' => 'Login@index'));

    $router->group([
        'middleware'    => 'admin_auth'
    ], function ($router) {
        /**
         * any new Routers here, because there is middleware for user auth
         * so another people cannt access directly
         */

        // HOMEPAGE
        Route::any('/dashboard', array('as' => 'admin_dashboard', 'uses' => 'Dashboard@index'));
        Route::any('/slideshow', array('as' => 'admin_slideshow', 'uses' => 'Slideshow@index'));
        Route::any('/banner', array('as' => 'admin_banner', 'uses' => 'Banner@index'));
        Route::any('/home_video', array('as' => 'admin_home_video', 'uses' => 'Content@video'));

        // NEWS AND EVENTS
        Route::any('/news-and-event-by-category', array('as' => 'admin_news-and-event-by-category', 'uses' => 'NewsAndEventsByCategory@index'));
        Route::any('/news-and-event', array('as' => 'admin_news-and-event', 'uses' => 'NewsAndEvents@index'));
        Route::any('/underlying', array('as' => 'admin_news-and-event', 'uses' => 'NewsAndEvents@underlying'));

        // PROMOTIONS
        Route::any('/promotions', array('as' => 'admin_promotions', 'uses' => 'Promotions@index'));

        // SERVICES
        Route::any('/services-by-category', array('as' => 'admin_services-by-category', 'uses' => 'ServicesByCategory@index'));
        Route::any('/services-by-category/gallery', array('as' => 'admin_services_by_category_gallery', 'uses' => 'ServicesByCategoryGallery@index'));
        Route::any('/services-by-subcategory', array('as' => 'admin_services-by-subcategory', 'uses' => 'ServicesBySubCategory@index'));
        Route::any('/services', array('as' => 'admin_services', 'uses' => 'Services@index'));

        // GALLERIES
        Route::any('/galleries-by-category', array('as' => 'admin_galleries-by-category', 'uses' => 'GalleriesByCategory@index'));
        Route::any('/galleries', array('as' => 'admin_galleries', 'uses' => 'Galleries@index'));

        // TEAM PROFILE
        // Route::any('/team-profile', array('as' => 'admin_team-profile', 'uses' => 'TeamProfile@index'));
        Route::any('/team-profile/schedule', array('as' => 'admin_schedule', 'uses' => 'Schedule@index'));

        Route::any('/team', array('as' => 'admin_team', 'uses' => 'Team@index'));
        Route::any('/team-image', array('as' => 'admin_team_image', 'uses' => 'TeamImage@index'));

        // DOWNLOAD
        Route::any('/download-by-category', array('as' => 'admin_download-by-category', 'uses' => 'DownloadByCategory@index'));
        Route::any('/download', array('as' => 'admin_download', 'uses' => 'Setting@download'));

        // ABOUT
        Route::any('/about-by-category', array('as' => 'admin_about_by_category', 'uses' => 'AboutByCategory@index'));
        Route::any('/about', array('as' => 'admin_about', 'uses' => 'Setting@about'));

        // CONTACTS
        Route::any('/contact_message', array('as' => 'admin_contact_message', 'uses' => 'ContactMessage@index'));
        Route::any('/contact_address', array('as' => 'admin_contact_address', 'uses' => 'ContactAddress@index'));
        Route::any('/contact_single_address', array('as' => 'admin_contact_single_address', 'uses' => 'Setting@address'));

        // STATIC PAGE
        Route::any('/static-page-on-menu', array('as' => 'admin_static_page_on_menu', 'uses' => 'StaticPageOnMenu@index'));
        Route::any('/static-page', array('as' => 'admin_static_page', 'uses' => 'StaticPage@index'));

        // SETTINGS
        Route::any('/administrator', array('as' => 'admin_administrator', 'uses' => 'Administrator@index'));
        Route::any('/setting', array('as' => 'admin_setting', 'uses' => 'Setting@index'));
        Route::any('/google_analytics', array('as' => 'admin_ga', 'uses' => 'Setting@ga'));
        Route::any('/upload_logo', array('as' => 'admin_upload_logo', 'uses' => 'Setting@uploadlogo'));
        Route::any('/instagram_feed', array('as' => 'admin_instagram_feed', 'uses' => 'Setting@instagramfeed'));
        // EVENT REGISTRATION
        Route::any('/events', array('as' => 'admin_events', 'uses' => 'Events@index'));
        Route::any('/event_categories', array('as' => 'admin_event_categories', 'uses' => 'EventCategories@index'));
        Route::any('/event_matches', array('as' => 'admin_event_matches', 'uses' => 'EventMatches@index'));
        Route::any('/event_schedule', array('as' => 'admin_event_schedule', 'uses' => 'EventSchedule@index'));
        Route::any('/event_team_members', array('as' => 'admin_event_team_members', 'uses' => 'EventTeamMembers@index'));
        Route::any('/event_teams', array('as' => 'admin_event_teams', 'uses' => 'EventTeams@index'));
        Route::any('/event_registrations', array('as' => 'admin_event_registrations', 'uses' => 'EventRegistrations@index'));

        Route::any('/newsletter', array('as' => 'admin_newsletter', 'uses' => 'Newsletter@index'));
        Route::any('/social_link', array('as' => 'admin_social_link', 'uses' => 'SocialLink@index'));
        Route::any('/custom-menu', array('as' => 'admin_custom_menu', 'uses' => 'CustomMenu@index'));
        Route::any('/seo', array('as' => 'admin_seo', 'uses' => 'Setting@seo'));
        Route::any('/others', array('as' => 'admin_others', 'uses' => 'Setting@others'));

        Route::any('/category', array('as' => 'admin_category', 'uses' => 'Category@index'));
        Route::any('/category/edit', array('as' => 'admin_categoryedit', 'uses' => 'Category@edit'));
        Route::any('/sub_category', array('as' => 'admin_sub_category', 'uses' => 'SubCategory@index'));
    });
});


/**
 * FRONTEND ROUTES
 *
 * Jaya Tennis Championship, at the site root. The Dua Sisi money changer and
 * Swarnadwipa themes that used to live here have been removed; the CMS beneath
 * them — the admin panel and the event modules — is untouched.
 **/
$router->group([
    'namespace' => 'Http\Controllers'
], function ($router) {
    Route::get('/', array('as' => 'tennis_home', 'uses' => 'Tennis@home'));
    Route::get('/schedule', array('as' => 'tennis_schedule', 'uses' => 'Tennis@schedule'));
    Route::get('/teams', array('as' => 'tennis_teams', 'uses' => 'Tennis@teams'));
    Route::get('/teams/{permalink}', array('as' => 'tennis_team', 'uses' => 'Tennis@team'));
    Route::get('/draw', array('as' => 'tennis_bracket', 'uses' => 'Tennis@bracket'));
    Route::get('/registration', array('as' => 'tennis_registration', 'uses' => 'Tennis@registration'));

    /**
     * Event registration — generic, keyed by event slug and registration code.
     */
    Route::post('/event/{slug}/register', array('as' => 'event_register', 'uses' => 'EventRegistration@store'));
    Route::get('/event/payment/{code}', array('as' => 'event_payment', 'uses' => 'EventRegistration@confirm'));
    Route::post('/event/payment/{code}', array('as' => 'event_payment_upload', 'uses' => 'EventRegistration@upload'));
});
