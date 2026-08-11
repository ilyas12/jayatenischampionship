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
												@if( $about_image != null )
													<img style="max-width:1280pxpx; max-height:383px;" src="{{ URL::asset('resources/assets/images/'.$about_image) }}">
												@else
													<img style="max-width:1280pxpx; max-height:383px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
												@endif
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 1280px; max-height: 383px;"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="about_image">
												</span>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												<p class="file-detail">For Best Resolution : 1435 x 429 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab" id="tab-4">
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Title</label>
									<div class="col-sm-5">
										{!! Form::text('about_title', $edit_data->about_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
							</div>
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('about_description', $edit_data->about_description, array('class'=>'form-control wysiwyg', 'placeholder'=>'')) !!}
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