<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')
    <div class="container custom-container-sm">
        <div class="row">
            <section class="page-section">
                <div class="col-md-12">
                    <div class="nav nav-tabs">
                        <ul class="nav-list">
                            @foreach( $pages as $page )
                            <li class="nav-menu-item {{ $page->name_alias == $pages_name ? 'active' : '' }}">
                                <a data-toggle="tab" href="#{!! $page->name_alias !!}">{!! $page->name !!}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="nav-static-page">
                        <div class="tab-content">
                            @foreach( $pages as $page )
                            <div id="{!! $page->name_alias !!}" class="tab-pane {{ $page->name_alias == $pages_name ? 'active' : '' }}">
                                <div class="img-wrapper">
                                    @if( $page->image != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/pages/'.$page->image) }}" class="img-responsive">
                                    @else
                                        <img src="{{ URL::asset('resources/assets/images/none_1435_429.png') }}" class="img-responsive">
                                    @endif
                                </div>
                                <div class="title">
                                    <h4>{!! $page->name !!}</h4>
                                    <span class="small-border"></span>
                                </div>

                                <div class="description">
                                    {!! $page->content !!}
                                </div>
                            </div>
                            @endforeach
                        </div><!-- tab-content -->
                    </div>
            </section>
        </div><!--row-->
    </div><!--container-->
    <?php /*@include('templates.parts.newsletter')
    @include('templates.parts.footer')*/ ?>
</body>
</html>