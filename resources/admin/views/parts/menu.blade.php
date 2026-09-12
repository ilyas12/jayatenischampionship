<header>
    <div id="header">
      <div class="container">
        <div class="logo"><a href="{{ URL::route('admin_slideshow') }}"><img src="{{ URL::asset('resources/assets/images/'.$admin_logo) }}"></a> </div>
        <div class="user-menu">
            <span>Welcome, Admin</span> | 
            <a class="sign_logout" href="{{ URL::to('_admin/logout') }}">Logout</a> | 
            <a class="sign_home" href="{{ URL::to('')}}" target="_blank">View Home</a>
        </div>
      </div>
    </div>
    <div id="menu">
        <div class="container">
            <div id="fade-menu" class="pull-left">
                <ul class="nav navbar-nav dropdown">
                    <li class="dropdown" {{ $page == "events" ? "class='active'" : '' }}>
                        <a href="#">Events</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_events') }}">Manage Events</a></li>
                            <li><a href="{{ URL::route('admin_event_registrations') }}">Registrations</a></li>
                            <li><a href="{{ URL::route('admin_event_teams') }}">Teams</a></li>
                            <li><a href="{{ URL::route('admin_event_team_members') }}">Team Players</a></li>
                            <li><a href="{{ URL::route('admin_event_schedule') }}">Schedule</a></li>
                            <li><a href="{{ URL::route('admin_event_matches') }}">Draw</a></li>
                            <li><a href="{{ URL::route('admin_event_categories') }}">Categories</a></li>
                            <li><a href="{{ URL::route('admin_event_partners') }}">Partners</a></li>
                        </ul>
                    </li>
                    <li class="dropdown" {{ $page == "homepage" ? "class='active'" : '' }}>
                        <a href="#">Homepage</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_slideshow') }}">Manage Slideshows</a></li>
                            {{--<li><a href="{{ URL::route('admin_banner') }}">Manage Banners</a></li>
                            <li><a href="{{ URL::route('admin_home_video') }}">Manage Videos</a></li>
                            <li><a href="{{ URL::route('admin_brand') }}">Manage Brands</a></li>--}}
                        </ul>
                    </li>
                    {{--<li class="dropdown">
                        <a href="#">Products</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>
                            <li><a href="{{ URL::route('admin_products_by_category') }}">Add Product</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">--}}
                        {{--<a href="#">Products by Sub Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_sub_category') }}">Add Sub Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_products_by_subcategory') }}">Add Product</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Products by Brand</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_brand') }}">Add Brand</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_products_by_brand') }}">Add Product</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_products') }}">Products</a>--}}
                    {{--</li>
                    <li class="dropdown">
                        <a href="#">Projects</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>
                            <li><a href="{{ URL::route('admin_projects_by_category') }}">Add Project</a></li>
                        </ul>
                    </li>
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Projects by Sub Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_sub_category') }}">Add Sub Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_projects_by_subcategory') }}">Add Project</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_projects') }}">Projects</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">News & Events by Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_news-and-event-by-category') }}">Add News & Event</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_news-and-event') }}">News & Events</a>
                    </li>
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_promotions') }}">Promotions</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Services by Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_services-by-category') }}">Add Services</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Services by Sub Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_sub_category') }}">Add Sub Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_services-by-subcategory') }}">Add Services</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_services') }}">Services</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Galleries by Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_galleries-by-category') }}">Add Gallery</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_galleries') }}">Galleries</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Press / Awards by Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Manage Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_press_by_category') }}">Manage Item Press</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_press') }}">Press / Awards</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Stores by Location</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_location') }}">Add Location</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_store_by_location') }}">Add Store</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_store') }}">Stores</a>
                    </li>
                    {{--<li class="dropdown">
                        <a href="{{ URL::route('admin_testimonial') }}">Testimonials</a>
                    </li>
                    <li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_team-profile') }}">Team Profile</a>--}}
                        {{--<a href="{{ URL::route('admin_team') }}">Team Profile</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">Download by Category</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_download-by-category') }}">Add Download</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_download') }}">Download Catalog</a>
                    </li>
                    {{--<li class="dropdown">--}}
                        {{--<a href="#">About</a>--}}
                        {{--<ul>--}}
                            {{--<li><a href="{{ URL::route('admin_category') }}">Add Category</a></li>--}}
                            {{--<li><a href="{{ URL::route('admin_about_by_category') }}">Manage About</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_about') }}">About</a>
                    </li>
                    {{--<li class="dropdown" {{ $page == "contact" ? "class='active'" : '' }}>
                        <a href="#">Contact</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_contact_message') }}">Manage Contact Message</a></li>
                            <li><a href="{{ URL::route('admin_contact_address') }}">Manage Address</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_contact_message') }}">Message</a>
                    </li>--}}
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_contact_single_address') }}">Contact</a>
                    </li>
                    {{--<li class="dropdown">--}}
                        {{--<a href="{{ URL::route('admin_static_page_on_menu') }}">Static Page</a>--}}
                    {{--</li>--}}
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_static_page') }}">Pages</a>
                    </li>
                   {{--<li class="dropdown">
                       <a href="#">Static Page</a>
                       <ul>
                           <li><a href="{{ URL::route('admin_static_page_on_menu') }}">On Hide</a></li>
                           <li><a href="{{ URL::route('admin_static_page') }}">Add Page</a></li>
                       </ul>
                   </li>--}}
                    <li class="dropdown" {{ $page == "system" ? "class='active'" : '' }}>
                        <a href="#">Global Configurations</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_custom_menu') }}">Menu</a></li>
                            <li><a href="{{ URL::route('admin_setting') }}">Email Configuration</a></li>
                            <li><a href="{{ URL::route('admin_upload_logo') }}">Upload Logo</a></li>
                            <li><a href="{{ URL::route('admin_social_link') }}">Social Link</a></li>
                            <li><a href="{{ URL::route('admin_instagram_feed') }}">Instagram Feed</a></li>
                            <li><a href="{{ URL::route('admin_newsletter') }}">Newsletter</a></li>
                            <li><a href="{{ URL::route('admin_seo') }}">SEO</a></li>
                            <li><a href="{{ URL::route('admin_administrator') }}">Administrator</a></li>
                            <li><a href="{{ URL::route('admin_others') }}">Others</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>