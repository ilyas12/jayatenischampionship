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
                                    <label class="col-sm-2 control-label">Image</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $contact_image != null )
                                                    <img style="max-width:1280pxpx; max-height:383px;" src="{{ URL::asset('resources/assets/images/'.$contact_image) }}">
                                                @else
                                                    <img style="max-width:1280pxpx; max-height:383px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 1280px; max-height: 383px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="contact_image">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 1595 x 477 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Address ( On Menu )</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('contact_single_address', $edit_data->contact_single_address, array('class'=>'form-control wysiwyg', 'placeholder'=>'Insert your Address here')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Contact ( On Menu )</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('contact_contacts', $edit_data->contact_contacts, array('class'=>'form-control wysiwyg', 'placeholder'=>'Insert your Contact here')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Contact US ( On Footer )</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('footer_contact_us', $edit_data->footer_contact_us, array('class'=>'form-control wysiwyg', 'placeholder'=>'Insert your Address here')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Latitude</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('contact_latitude', $edit_data->contact_latitude, array('class'=>'form-control', 'placeholder'=>'Insert Your Latitude')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Longitude</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('contact_longitude', $edit_data->contact_longitude, array('class'=>'form-control', 'placeholder'=>'Insert Your Longitude')) !!}
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