
        <div class="footer-content">
            <div class="container custom-container-sm">
                <div class="row">
                    <div class="col-md-8 no-padding">
<!--                         <div class="col-md-4 footer-collapse">
                            <div class="footer-title">
                                Terre
                                <div class="footer-open-icon">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>
                            <ul class="footer-list-menu">
                                <li>
                                    <a href="{{ URL::route('about') }}">About</a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('contact') }}">Contact</a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('news_and_events') }}">News & Events</a>
                                </li>
                                @if ( $download !== '' )
                                <li>
                                    <a href="{{ URL::route('download_catalog') }}" target="_blank">Download Catalog</a>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <div class="col-md-4 footer-collapse">
                            <div class="footer-title">
                                Support
                                <div class="footer-open-icon">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>
                            <ul class="footer-list-menu">
                                @foreach( $support as $s )
                                <li>
                                    <a href="{{ url('pages') }}/{{ $s->name_alias }}">{{ $s->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
 -->
                       
                            <div class="footer-title">
                                HEAD OFFICE
                            </div>
                            <div class="info-contact">
                                {!! $footer_contact_us !!}
                            </div>
                        
                    </div><!-- col-md-8 -->

                    <div class="col-md-2 col-md-offset-2"> 
                        <div class="footer-title">
                            Connect
                        </div>
                        <div class="footer-social-icon">
                            <ul>
                                @foreach( $social_link as $sl )
                                <li>
                                    <a href="{{ $sl->link }}" target="_blank"><i class="fa {{ $sl->icon }}"></i></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- col-md-3-->

                    <div class="col-md-12 footer-copyright">
                        Duasisi Money Changer indonesia 2022. Developed by <a href="#" target="_blank"><strong>Duasisi Money Change</strong> Team</a>
                    </div>
                </div><!-- row -->
            </div><!-- container -->
        </div><!-- footer-content -->
    </footer>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#{{ Route::currentRouteName() }}").addClass("active");
        });
    </script>