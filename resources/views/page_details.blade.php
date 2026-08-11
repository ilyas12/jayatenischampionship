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
                    <div class="nav-static-page">
                        <div class="tab-content">
                            <div id="faq" class="tab-pane active">
                                <div class="img-wrapper">
                                    <img src="{{ URL::asset('resources/assets/uploads/pages/'.$page_details['image']) }}" class="img-responsive">
                                </div>
                                <div class="title">
                                    <h4>{!! $page_details['name'] !!}</h4>
                                    <span class="small-border"></span>
                                </div>

                                <div class="description">
                                    {!! $page_details['content'] !!}
                                </div>
                            </div>
                        </div><!-- tab-content -->
                    </div>
            </section>
        </div><!--row-->
    </div><!--container-->
</body>
</html>