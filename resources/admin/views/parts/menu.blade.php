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
                        </ul>
                    </li>
                    <li class="dropdown" {{ $page == "homepage" ? "class='active'" : '' }}>
                        <a href="#">Homepage</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_slideshow') }}">Manage Slideshows</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_news-and-event') }}">News &amp; Events</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_about') }}">About</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_contact_single_address') }}">Contact</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ URL::route('admin_static_page') }}">Pages</a>
                    </li>
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
