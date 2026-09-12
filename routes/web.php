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
        Route::any('/brand', array('as' => 'admin_brand', 'uses' => 'Brand@index'));

        // PRODUCTS
        Route::any('/products-by-category', array('as' => 'admin_products_by_category', 'uses' => 'ProductByCategory@index'));
        Route::any('/products-image-category', array('as' => 'admin_products_image_category', 'uses' => 'ProductImageByCategory@index'));
        Route::any('/products-by-subcategory', array('as' => 'admin_products_by_subcategory', 'uses' => 'ProductBySubCategory@index'));
        Route::any('/products-image-subcategory', array('as' => 'admin_products_image_subcategory', 'uses' => 'ProductImageBySubCategory@index'));
        Route::any('/products-by-brand', array('as' => 'admin_products_by_brand', 'uses' => 'ProductByBrand@index'));
        Route::any('/products-image-brand', array('as' => 'admin_products_image_brand', 'uses' => 'ProductImageByBrand@index'));
        Route::any('/products', array('as' => 'admin_products', 'uses' => 'Product@index'));
        Route::any('/products-image', array('as' => 'admin_products_image', 'uses' => 'ProductImage@index'));

        // PROJECT
        Route::any('/projects-by-category', array('as' => 'admin_projects_by_category', 'uses' => 'ProjectByCategory@index'));
        Route::any('/projects-image-category', array('as' => 'admin_projects_image_category', 'uses' => 'ProjectImageByCategory@index'));
        Route::any('/projects-by-subcategory', array('as' => 'admin_projects_by_subcategory', 'uses' => 'ProjectBySubCategory@index'));
        Route::any('/projects-image-subcategory', array('as' => 'admin_projects_image_subcategory', 'uses' => 'ProjectImageBySubCategory@index'));
        Route::any('/projects', array('as' => 'admin_projects', 'uses' => 'Project@index'));
        Route::any('/projects-image', array('as' => 'admin_projects_image', 'uses' => 'ProjectImage@index'));

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

        // PRESS
        Route::any('/press-by-category', array('as' => 'admin_press_by_category', 'uses' => 'PressByCategory@index'));
        Route::any('/press', array('as' => 'admin_press', 'uses' => 'Press@index'));
        Route::any('/press/album', array('as' => 'admin_press_album', 'uses' => 'PressAlbum@index'));

        // STORES
        Route::any('/location', array('as' => 'admin_location', 'uses' => 'Location@index'));
        Route::any('/stores-by-location', array('as' => 'admin_store_by_location', 'uses' => 'StoreByLocation@index'));
        Route::any('/stores', array('as' => 'admin_store', 'uses' => 'Store@index'));

        // TESTIMONIALS
        Route::any('/testimonials', array('as' => 'admin_testimonial', 'uses' => 'Testimonials@index'));

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
        Route::any('/event_partners', array('as' => 'admin_event_partners', 'uses' => 'EventPartners@index'));

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
 * Jaya Tennis Championship, 2026 theme — sliced from JTC_Desktop_Master_New.psd
 * and serving the site root. The theme it replaced is parked under old/, which
 * is where to look for the queries that wired these pages to the CMS.
 **/
$router->group([
    'namespace' => 'Http\Controllers'
], function ($router) {
    Route::get('/', array('as' => 'jtc_home', 'uses' => 'Jtc@home'));
    Route::get('/past-winners', array('as' => 'jtc_past_winners', 'uses' => 'Jtc@pastWinners'));
    Route::get('/schedule', array('as' => 'jtc_schedule', 'uses' => 'Jtc@schedule'));
    Route::get('/draw', array('as' => 'jtc_draw', 'uses' => 'Jtc@draw'));
    Route::get('/register', array('as' => 'jtc_register', 'uses' => 'Jtc@register'));

    /**
     * Event registration — generic, keyed by event slug and registration code.
     * Still live: the admin verifies entries through it, and the confirmation
     * page is the only public page that writes to the database.
     */
    Route::post('/event/{slug}/register', array('as' => 'event_register', 'uses' => 'EventRegistration@store'));
    Route::get('/event/payment/{code}', array('as' => 'event_payment', 'uses' => 'EventRegistration@confirm'));
    Route::post('/event/payment/{code}', array('as' => 'event_payment_upload', 'uses' => 'EventRegistration@upload'));

    /**
     * Editorial pages by slug — privacy, terms, contact. Last on purpose: it
     * matches a single segment, so every named route above claims its own path
     * first and this only sees what is left.
     */
    Route::get('/{permalink}', array('as' => 'jtc_page', 'uses' => 'Jtc@page'))
        ->where('permalink', '[a-z0-9][a-z0-9-]*');
});
