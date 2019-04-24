<?php 
	use App\Kinder;
	$group = \Auth::user()->group;
	if($group == 0){
		$kinder = Kinder::getKinderByUser(Auth::user()->id);
	}
?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="user-scalable=no" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link rel="shortcut icon" href="/img/common/favicon.ico"/>
        <title>{{ config('app.name', 'Laravel') }}</title>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Jquery UI -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="{{ asset('js/datepicker-ja.js') }}"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
		@stack('custom_css')

		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/fix.css') }}" rel="stylesheet">
		<link href="{{ asset('css/update.css') }}" rel="stylesheet">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('js/footerFixed.js') }}"></script> --}}
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
		
		<script>
			$(function() {
				var agent			= navigator.userAgent;
				var contentWidth	= 1280;							//コンテンツ幅
				var breakPoint		= 641;							//ブレイクポイント

				if( ( agent.search(/iPhone/) != -1 ) || ( agent.search(/iPad/) != -1 ) || ( agent.search(/Android/) != -1 ) ){
					var windowWidth	= $(window).width();

					if( ( windowWidth <= contentWidth ) && ( windowWidth >= breakPoint ) ){
						zoom = ( windowWidth / contentWidth ) * 100;
						$('body').css('zoom',zoom+'%');
					}
				}
			});
		</script>

		<title>マイページ</title>
	</head>

	<body><div id="wrapper">
			<div id="header" class="clearfix">
				<div class="header_left">
					<div class="header_logo">
						<a href="/"><img height="40" src="/img/header_logo_new.png"></a>
					</div>
				</div>
					<div class="header_right">
					<p class="header_para01">
						<?php if($group == 0) :?>
							ようこそ
							<?php if(isset($kinder) && !empty($kinder)):?>
								<?php echo $kinder->name;?>
								<?php echo $kinder->contact_name;?> さん
							<?php endif;?>
						<?php else:?>
							ようこそ
							{{ auth()->user()->contact_name }} さん
						<?php endif;?>
						<!-- <a href="/mypage/update">登録者情報変更</a> -->
					</p>
					<div class="header_user">
						<ul class="user-options">	

							@if(auth()->user()->group == 0)
							<li class="profile-drop-down">
								<img src="/img/header_icon.png">
								<ul class="profile-drop-down-content">
									<li class="btn_1">
										<a href="{{route("kinder")}}" class="btn_1_link">アカウント情報</a>
									</li>
								{{-- 	<li class="gnav_08">
										<a href="#" class="btn_1_link">園情報</a>
									</li> --}}
									<li class="gnav_08">
											<a href="{{route("kinder.schoollinkcode")}}" class="btn_1_link">園連携コード確認</a>
										</li>
										<li class="gnav_08">
											<a href="{{route("logout")}}" class="btn_1_link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											     {{ csrf_field() }}
											 </form>
										</li>
{{-- 									<li 132pxclass="logoutbut">
										<hr>											
										<div class="header_logout">
										<a href="https://prodev.kids-meal.jp/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
											<img src="/img/header_logout_new.png">
				                        </a>

									</div>
								</li> --}}
							</ul>
							@elseif(auth()->user()->group == 1)	
							<li class="profile-drop-down">
								<img src="/img/header_icon.png">
								<ul class="profile-drop-down-content">
									<li class="btn_1">
										<a href="{{route("kinder")}}" class="btn_1_link">アカウント情報</a>
									</li>
									<li class="gnav_08">
										<a href="{{route("logout")}}" class="btn_1_link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										     {{ csrf_field() }}
										 </form>
									</li>
								</ul>
							</li> 	
							@elseif(auth()->user()->group == 2)	
							<li class="profile-drop-down">
								<img src="/img/header_icon.png">
								<ul class="profile-drop-down-content">
									<li class="btn_1">
										<a href="{{route("system_account.edit")}}" class="btn_1_link">アカウント情報</a>
									</li>
						{{-- 			<li class="gnav_08">
										<a href="#" class="btn_1_link">園情報</a>
									</li> --}}
					{{-- 				<li class="gnav_08">
										<a href="{{route("kinder.schoollinkcode")}}" class="btn_1_link">園連携コード確認</a>
									</li> --}}
									<li class="gnav_08">
										<a href="{{route("logout")}}" class="btn_1_link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										     {{ csrf_field() }}
										 </form>
									</li>
{{-- 									<li 132pxclass="logoutbut">
										<hr>											
										<div class="header_logout">
											<a href="https://prodev.kids-meal.jp/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
												<img src="/img/header_logout_new.png">
					                        </a>
										</div>
									</li> --}}
								</ul>
							</li> 	
							@endif	

						</ul>
			
					</div>
				</div>
			</div>
			<!-- header -->

		
          
		
			<div id="main">			
				@if(auth()->user()->group == 0)
					@include('system.layouts.kinder_sidebar')	
				@elseif(auth()->user()->group == 1)	
					@include('system.layouts.educe_sidebar')	
				@elseif(auth()->user()->group == 2)
					@include('system.layouts.system_sidebar')	
				@endif		  
			  
			 	<!--When something need to adjust with main inner for specific page , please use custom_class  -->

			 	<div class="main_inner custom_class">
				 	@include('flash::message')
			 			<div class="clear_both">
		                    @yield('content')
			 			</div>
				</div>
			</div><!-- main -->
		</div><!-- wrapper -->
		@stack('custom_js')
		<script>
			$(document).ready(function(){
				$('.drop-down').click(function(){
					$(this + ' .drop-down-content').show();			
				});

				$('.profile-drop-down').click(function(){
					$('.profile-drop-down-content').css("left","100px");
					$('.profile-drop-down-content').toggle();
				});
			})
		</script>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo config('custom.google_analytics_key');?>"></script>
		<script>
	  		window.dataLayer = window.dataLayer || [];
		  	function gtag(){dataLayer.push(arguments);}
		  	gtag('js', new Date());
		
		  	gtag('config', '<?php echo config('custom.google_analytics_key');?>');
		</script>
		
	</body>
</html>
