<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="user-scalable=no" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link rel="shortcut icon" href="./img/common/favicon.ico"/>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all">

		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>

		<script src="{{ asset('js/footerFixed.js') }}"></script>

		<title>ログイン</title>
	</head>

	<body>
		<div id="wrapper" class="login_wrapper">
			<div class="eds_01_01">
				<div class="form-sec">
					<h2><img src="/img/logo_pro.png" alt=""></h2>
                  
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

						@if ($errors->has('username'))
						<center class="login-error">
							<font color="red">{{ $errors->first('username') }}</font>
						</center>
						 @elseif ($errors->has('password'))
						<center class="login-error">
							<font color="red">{{ $errors->first('password') }}</font>
						</center>
						@elseif ($errors->has('g-recaptcha-response'))
						<center class="login-error">
							<font color="red">{{ $errors->first('g-recaptcha-response') }}</font>
						</center>
                         @endif
                      
										
						<div class="user-id">
							<input type="text" name="username" placeholder="ログインID" value="{{ old('username') }}">
							<span class="id-img">
								<img src="/img/login_id_icon.png" alt="ログインID">
							</span>
						</div>
						<div class="user-pass">
							<input type="password" name="password" placeholder="パスワード" value="" autocomplete="off">
							<span class="pass-img">
								<img src="/img/login_pass_icon.png" alt="パスワード">
							</span>
						</div>
						<br/>
						<div class="user-id">
							<div class="g-recaptcha" data-sitekey="<?php echo config('custom.google_captcha_site_key');?>"></div>
						</div>
						<input type="submit" class="login-btn" value="ログイン">
					</form>
				</div>
				<!-- form-sec -->
			</div>
			<!-- eds_01_01 -->
		</div>
		<!-- wrapper -->
	</body>
</html>
