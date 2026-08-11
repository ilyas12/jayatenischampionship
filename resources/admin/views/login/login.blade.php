<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 12:05 PM
 */
?>
<html>
<head>
    @include('admin::parts.meta')
	@include('admin::parts.css')
    <script>
		$(function(){
			$('input[name=email]').focus();
		});
	</script>
</head>
<body id="body_colour">
	<div id="header_login">
		<center>
	    	<img src="{{ URL::asset('resources/assets/images/'.$website_logo) }}" style="max-height:100px;">
	    </center>
	    <p>ADMIN LOGIN ACCESS</p>
	</div>
	<div id="content_login">
		<div class="login-error">
			{!! $errors->first('email') !!}
			{!! $errors->first('password') !!}
		</div>

		{!! Form::open(array('url' => '_d50d0608e7c3270b3f0e3753f996387b/login/dologin', 'method'=>'post', 'id' => 'formlogin')) !!}

	    	<input type="text" name="email" placeholder="Email">
	        <input type="password" name="password" placeholder="Password">
	        <input type="submit" value="LOGIN">
	        <label class="errorText"></label>

		{!! Form::close() !!}
	</div>
	<div id="footer_login">Powered by DUASISI</div>
</body>
</html>