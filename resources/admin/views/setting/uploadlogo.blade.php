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
                        <div id="message">{!! Alert::get('success') !!}</div>
                        <div id="userinteract">
                            {!! Form::open(array('files'=>true, 'id'=>'form-scaffold'), 'POST') !!}
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Website</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $website_logo != null )
                                                <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$website_logo) }}">
                                                @else
                                                <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="website_logo">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 200 x 150 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Dashboard</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $dashboad_logo != null )
                                                <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$dashboad_logo) }}">
                                                @else
                                                <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="admin_logo">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 200 x 150 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Login Admin</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $login_admin_logo != null )
                                                <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$login_admin_logo) }}">
                                                @else
                                                <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="login_admin_logo">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 200 x 150 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Favicon</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $favicon_logo != null )
                                                <img style="max-width:16px; max-height:16px;" src="{{ URL::asset('resources/assets/images/'.$favicon_logo) }}">
                                                @else
                                                <img style="max-width:16px; max-height:16px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="website_favicon">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 16 x 16 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
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