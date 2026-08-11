<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin::parts/head')
    <script>
        $(function(){
            $("#tab-nav a").click(function(){
                $(".tab").hide();
                $($(this).attr('href')).show();
                $(".current").removeClass('current');
                $(this).parents('li').addClass('current');

                return false;
            });
            $("#tab-nav a:first").trigger('click');
        });
    </script>
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
            <div class="col-xs-2">
                <div class="sidebar">
                    <ul id="tab-nav">
                        {{--<li class="current"><a href="#tab-1">+ Pop Up</a></li>--}}
                        <li><a href="#tab-2">+ Google Analytics</a></li>
                        <li><a href="#tab-3">+ 404 Page</a></li>
                        <li><a href="#tab-4">+ Maintenance Page</a></li>
                        <li><a href="#tab-5">+ IP Whitelist</a></li>
                        <li><a href="#tab-6">+ Google Maps</a></li>
                        <li><a href="#tab-7">+ Underlying</a></li>
                        <li><a href="#tab-8">+ Rates Source</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-10">
                <div class="portlet">
                    <div class="portlet-header">
                        <h4>Edit Form</h4>
                        <i class="icsw16-graph icsw16-white pull-right"></i>
                    </div>
                    <div class="portlet-content cnt_b">
                        <div id="message">{!! Alert::get('success') !!}</div>
                        <div id="userinteract">
                            {!! Form::open(array('files'=>true, 'id'=>'form-scaffold'), 'POST') !!}
                            {{--<div class="tab" id="tab-1">--}}
                                {{--<div class="form-group clearfix">--}}
                                    {{--<label class="col-sm-2 control-label">Image</label>--}}
                                    {{--<div class="col-sm-5">--}}
                                        {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}
                                            {{--<div class="fileinput-new thumbnail">--}}
                                                {{--@if( $popup_image != null )--}}
                                                    {{--<img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$popup_image) }}">--}}
                                                {{--@else--}}
                                                    {{--<img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                            {{--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>--}}
                                            {{--<div>--}}
												{{--<span class="btn btn-default btn-file">--}}
													{{--<span class="fileinput-new">Select image</span>--}}
													{{--<span class="fileinput-exists">Change</span>--}}
													{{--<input type="file" name="popup_image">--}}
												{{--</span>--}}
                                                {{--<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>--}}
                                                {{--<p class="file-detail">For Best Resolution : 1920 x 1080 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group clearfix">--}}
                                    {{--<label class="col-sm-2 control-label">E-mail Newsletter</label>--}}
                                    {{--<div class="col-sm-5">--}}
                                        {{--{!! Form::text('popup_email_newsletter', $edit_data->popup_email_newsletter, array('class'=>'form-control', 'placeholder'=>'')) !!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="tab" id="tab-2">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Tracking Code ID</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('ga_code', $edit_data->ga_code, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-3">
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('error404_title', $edit_data->error404_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Title Text Colour</label>
                                    <div class="col-sm-2">
                                        {!! Form::text('error404_title_colour', $edit_data->error404_title_colour, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Sub Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('error404_subtitle', $edit_data->error404_subtitle, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Sub Title Text Colour</label>
                                    <div class="col-sm-2">
                                        {!! Form::text('error404_subtitle_colour', $edit_data->error404_subtitle_colour, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Message</label>
                                    <div class="col-sm-9">
                                        {!! Form::textarea('error404_message', $edit_data->error404_message, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Message Colour</label>
                                    <div class="col-sm-2">
                                        {!! Form::text('error404_message_colour', $edit_data->error404_message_colour, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Button Text</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('error404_button_text', $edit_data->error404_button_text, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Button Text Colour</label>
                                    <div class="col-sm-2">
                                        {!! Form::text('error404_button_text_colour', $edit_data->error404_button_text_colour, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Button Background Colour</label>
                                    <div class="col-sm-2">
                                        {!! Form::text('error404_button_background_colour', $edit_data->error404_button_background_colour, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Background Image</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $error404_background_image != null )
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$error404_background_image) }}">
                                                @else
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="error404_background_image">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 1920 x 1080 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Mode</label>
                                    <div class="col-xs-5">
                                        <input name="maintenance_mode" type="radio" value="1" {{ $edit_data->maintenance_mode == 1 ? 'checked="checked"' : '' }}> On
                                        <input name="maintenance_mode" type="radio" value="0" {{ $edit_data->maintenance_mode == 0 ? 'checked="checked"' : '' }}> Off
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Text Line - 1</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_text_1', $edit_data->mt_text_1, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Text Line - 2</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_text_2', $edit_data->mt_text_2, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Text Line - 3</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_text_3', $edit_data->mt_text_3, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact Icon - 1</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $mt_contact_1_icon != null )
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$mt_contact_1_icon) }}">
                                                @else
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="mt_contact_1_icon">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 50 x 50 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact - 1</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_contact_1', $edit_data->mt_contact_1, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact Icon - 2</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $mt_contact_2_icon != null )
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$mt_contact_2_icon) }}">
                                                @else
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="mt_contact_2_icon">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 50 x 50 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact - 2</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_contact_2', $edit_data->mt_contact_2, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact Icon - 3</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $mt_contact_3_icon != null )
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$mt_contact_3_icon) }}">
                                                @else
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="mt_contact_3_icon">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 50 x 50 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact - 3</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_contact_3', $edit_data->mt_contact_3, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact Icon - 4</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $mt_contact_4_icon != null )
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/'.$mt_contact_4_icon) }}">
                                                @else
                                                    <img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="mt_contact_4_icon">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 50 x 50 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 2Mb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Contact - 4</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mt_contact_4', $edit_data->mt_contact_4, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-5">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">IP Whitelist</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('ip_whitelist', $edit_data->ip_whitelist, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                        <div class="form-suffix clearfix">
                                            <br>Notes :<br>- Your IP Address : {{ Request::ip() }}<br>- To added more IP Address use semicolon ( ; )
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-6">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Marker</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if( $marker != null )
                                                <img style="max-width:50px; max-height:50px;" src="{{ URL::asset('resources/assets/images/'.$marker) }}">
                                                @else
                                                <img style="max-width:50px; max-height:50px;" src="{{ URL::asset('resources/assets/images/none.png') }}">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 50px; max-height: 50px;"></div>
                                            <div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="marker">
												</span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                <p class="file-detail">For Best Resolution : 50 x 50 px<br>File Type : .jpg | .jpeg | .png<br>Max Size : 200 Kb</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{--<p>Mulai</p>--}}
                            <div class="tab" id="tab-7">

                                <!-- Main Title -->
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Underlying Title</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('underlying_title', $edit_data->underlying_title, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                            
                                <hr>
                            
                                <h4 class="col-sm-offset-3">Individual - Jakarta</h4>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('underlying_individual_jkt_title', $edit_data->underlying_individual_jkt_title, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Document</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            
                                            <div class="fileinput-new thumbnail" style="padding:15px;">
                                                @if(!empty($edit_data->underlying_individual_jkt_files))
                                                    <div style="margin-top: 10px;" class="file-preview-box">
                                                        <label style="display: block; color: #6c757d; font-size: 12px; margin-bottom: 5px;">
                                                            Current Attached File:
                                                        </label>
                                                        
                                                        <?php
                                                            // Laravel 3 File helper to fetch the extension cleanly
                                                            $extension = File::extension($edit_data->underlying_individual_jkt_files);
                                                            
                                                            // Native PHP to get the clean filename
                                                            $fileName = basename($edit_data->underlying_individual_jkt_files);
                                                            
                                                            // Building the asset URL using your exact path structure
                                                            $filePath = URL::asset($edit_data->underlying_individual_jkt_files);
                                                        ?>
                                                
                                                        <a href="<?php echo $filePath; ?>" target="_blank" class="btn-file-preview" style="display: inline-flex; align-items: center; text-decoration: none; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; color: #333;">
                                                            
                                                            <span style="margin-left: 8px;">
                                                                <?php echo $fileName; ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>
                            
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            
                                            <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select File</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="underlying_individual_jkt_files">
                                                </span>
                            
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                    Remove
                                                </a>
                            
                                                <p class="file-detail">
                                                    PDF / DOC / DOCX / ZIP<br>
                                                    Max Size : 5Mb
                                                </p>
                                            </div>
                            
                                        </div>
                                    </div>
                                </div>
                            
                                <hr>
                            
                                <h4 class="col-sm-offset-3">Individual - Surabaya</h4>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('underlying_individual_sby_title', $edit_data->underlying_individual_sby_title, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Document</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            
                                            <div class="fileinput-new thumbnail" style="padding:15px;">
                                                 @if(!empty($edit_data->underlying_individual_sby_files))
                                                    <div style="margin-top: 10px;" class="file-preview-box">
                                                        <label style="display: block; color: #6c757d; font-size: 12px; margin-bottom: 5px;">
                                                            Current Attached File:
                                                        </label>
                                                        
                                                        <?php
                                                            // Laravel 3 File helper to fetch the extension cleanly
                                                            $extension = File::extension($edit_data->underlying_individual_sby_files);
                                                            
                                                            // Native PHP to get the clean filename
                                                            $fileName = basename($edit_data->underlying_individual_sby_files);
                                                            
                                                            // Building the asset URL using your exact path structure
                                                            $filePath = URL::asset($edit_data->underlying_individual_sby_files);
                                                        ?>
                                                
                                                        <a href="<?php echo $filePath; ?>" target="_blank" class="btn-file-preview" style="display: inline-flex; align-items: center; text-decoration: none; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; color: #333;">
                                                            
                                                            <span style="margin-left: 8px;">
                                                                <?php echo $fileName; ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                            
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            
                                            <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select File</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="underlying_individual_sby_files">
                                                </span>
                            
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                    Remove
                                                </a>
                            
                                                <p class="file-detail">
                                                    PDF / DOC / DOCX / ZIP<br>
                                                    Max Size : 5Mb
                                                </p>
                                            </div>
                            
                                        </div>
                                    </div>
                                </div>
                            
                                <hr>
                            
                                <h4 class="col-sm-offset-3">Corporate - Jakarta</h4>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('underlying_corporate_jkt_title', $edit_data->underlying_corporate_jkt_title, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Document</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            
                                            <div class="fileinput-new thumbnail" style="padding:15px;">
                                                @if(!empty($edit_data->underlying_corporate_jkt_files))
                                                    <div style="margin-top: 10px;" class="file-preview-box">
                                                        <label style="display: block; color: #6c757d; font-size: 12px; margin-bottom: 5px;">
                                                            Current Attached File:
                                                        </label>
                                                        
                                                        <?php
                                                            // Laravel 3 File helper to fetch the extension cleanly
                                                            $extension = File::extension($edit_data->underlying_corporate_jkt_files);
                                                            
                                                            // Native PHP to get the clean filename
                                                            $fileName = basename($edit_data->underlying_corporate_jkt_files);
                                                            
                                                            // Building the asset URL using your exact path structure
                                                            $filePath = URL::asset($edit_data->underlying_corporate_jkt_files);
                                                        ?>
                                                
                                                        <a href="<?php echo $filePath; ?>" target="_blank" class="btn-file-preview" style="display: inline-flex; align-items: center; text-decoration: none; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; color: #333;">
                                                            
                                                            <span style="margin-left: 8px;">
                                                                <?php echo $fileName; ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                            
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            
                                            <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select File</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="underlying_corporate_jkt_files">
                                                </span>
                            
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                    Remove
                                                </a>
                            
                                                <p class="file-detail">
                                                    PDF / DOC / DOCX / ZIP<br>
                                                    Max Size : 5Mb
                                                </p>
                                            </div>
                            
                                        </div>
                                    </div>
                                </div>
                            
                                <hr>
                            
                                <h4 class="col-sm-offset-3">Corporate - Surabaya</h4>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('underlying_corporate_sby_title', $edit_data->underlying_corporate_sby_title, array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label">Document</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            
                                            <div class="fileinput-new thumbnail" style="padding:15px;">
                                                @if(!empty($edit_data->underlying_corporate_sby_files))
                                                    <div style="margin-top: 10px;" class="file-preview-box">
                                                        <label style="display: block; color: #6c757d; font-size: 12px; margin-bottom: 5px;">
                                                            Current Attached File:
                                                        </label>
                                                        
                                                        <?php
                                                            // Laravel 3 File helper to fetch the extension cleanly
                                                            $extension = File::extension($edit_data->underlying_corporate_sby_files);
                                                            
                                                            // Native PHP to get the clean filename
                                                            $fileName = basename($edit_data->underlying_corporate_sby_files);
                                                            
                                                            // Building the asset URL using your exact path structure
                                                            $filePath = URL::asset($edit_data->underlying_corporate_sby_files);
                                                        ?>
                                                
                                                        <a href="<?php echo $filePath; ?>" target="_blank" class="btn-file-preview" style="display: inline-flex; align-items: center; text-decoration: none; padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; color: #333;">
                                                            
                                                            <span style="margin-left: 8px;">
                                                                <?php echo $fileName; ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                            
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            
                                            <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select File</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="underlying_corporate_sby_files">
                                                </span>
                            
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                    Remove
                                                </a>
                            
                                                <p class="file-detail">
                                                    PDF / DOC / DOCX / ZIP<br>
                                                    Max Size : 5Mb
                                                </p>
                                            </div>
                            
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