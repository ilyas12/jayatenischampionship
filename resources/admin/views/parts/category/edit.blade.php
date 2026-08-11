<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin::parts/head')
</head>
<body>
<div id="full-container">
    @include('admin::parts/menu')
    <div id="page-info">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h1><?php echo $page_title;?></h1>
                </div>
                <div class="col-xs-6">
                    <div class="btn-holder">
                        <a href="#" class="btn btn-info save-button" onclick="return submit_form();"><i class="glyphicon glyphicon-floppy-disk"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        {!! $breadcrumb !!}
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet">
                    <div class="portlet-header">
                        <h4>EDIT CATEGORY</h4>
                        <i class="icsw16-graph icsw16-white pull-right"></i>
                    </div>
                    <div class="portlet-content cnt_b">
                        <div id="message">{!! Alert::get('success') !!}</div>
                        <form method="POST" action="{{ URL::to('_admin/category/edit?category_id='$edit_data->id) }}" accept-charset="UTF-8" id="form-scaffold"><input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-5">
                                {!! Form::text('name', $edit_data->name, array('class'=>'form-control', 'placeholder'=>'')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin::parts/footer')
</div>
</body>
</html>