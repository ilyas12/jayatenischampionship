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
                        <h4>Edit Form</h4>
                        <i class="icsw16-graph icsw16-white pull-right"></i>
                    </div>
                    <div class="portlet-content cnt_b">
                        <div id="message">{!! Alert::show() !!}</div>
                        <div id="userinteract">
                            {!! Form::open(array('files'=>true, 'id'=>'form-scaffold'), 'POST') !!}
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Instagram User ID</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('instagram_userid', $edit_data->instagram_userid, array('class'=>'form-control', 'placeholder'=>'Insert Your Instagram User ID')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Instagram Hashtag #</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('instagram_hastag', $edit_data->instagram_hastag, array('class'=>'form-control', 'placeholder'=>'Insert Your Instagram Hashtag')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Instagram Message</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('instagram_message', $edit_data->instagram_message, array('class'=>'form-control', 'placeholder'=>'Insert your Instagram Message')) !!}
                                        <div class="form-suffix clearfix">Max : 100 characters</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Instagram Feed Code</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('instagram_feed', $edit_data->instagram_feed, array('class'=>'form-control', 'placeholder'=>'Insert your Instawidget code here')) !!}
                                        <div class="form-suffix clearfix">Notes : <br/>Open <a href="http://instawidget.net/generate" target="_blank">http://instawidget.net/generate</a>. Insert field, and then copy paste code.</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="save" value="1"/>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin::parts/footer')
</div>
</body>
</html>