	<ul id="left-sidebar">	
		<li class="menu-item">
			<i class="fas fa-home"></i>
			<a href="#">HOME</a>
		</li> 
				
		<li class="menu-item">
			<i class="fas fa-bars"></i>
			<a href="#">献立</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route('kinder-menu.index')}}">今日の献立</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('buono.kondate')}}">献立編集</a>
				</li><li class="inner-menu-list">
					<a href="{{route('buono.kondate.upload')}}">献立CSVインポート</a>
				</li>
			</ul>
		</li>
				
		<li class="menu-item">
			<i class="fas fa-list-ol"></i>
			<a href="#">献立表・給食だより</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route('kondate')}}">献立表</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('kyusyoku')}}">給食だより</a>
				</li> 
			</ul>
		</li> 	
			
		<li class="menu-item">
			<i class="fas fa-envelope"></i>
			<a href="#">各種通知</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route('message')}}">メッセージ</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('notification')}}">お知らせ</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('system.message')}}">管理者メッセージ</a>
				</li>
			</ul>
		</li>			
						
		<li class="menu-item">
			<i class="fas fa-university"></i>
			<a href="#">園管理</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route('user_detail.index')}}">園連携ユーザー一覧</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('classroom')}}">クラス</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('kid',2)}}">園児</a>
				</li>
{{-- 				<li class="inner-menu-list">
					<a href="#">成長記録</a>
				</li> --}}
			</ul>
		</li>
				
		<li class="menu-item">
			<i class="fas fa-sliders-h"></i>
			<a href="#">各種設定</a>
			<ul class="inner-menu">
{{-- 				<li class="inner-menu-list">
					<a href="{{route('push.message')}}">自動プッシュ通知</a>
				</li> --}}
				<li class="inner-menu-list">
					<a href="{{route("kinder.setting")}}">食種・献立区分</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('nutrition')}}">栄養評価基準</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("kinder.setting")}}"">成長記録データ共有</a>
				</li>
			</ul>
		</li>			

		<li class="menu-item">
			<i class="fas fa-file-alt"></i>
			<a href="#">マニュアル</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{ asset('pdf/KidsMealPro_UserManual_Rev1.00.pdf') }}" target="_blank">Kids Meal Pro利用手引き</a>
				</li>
			</ul>
		</li>

		<li>
			<p class="sidebar-copyright">
				<a href="{{route("terms_of_use")}}" class="term-of-use">利用規約</a><br>
				Copyright ©2019 Meal Care Co., LTD. All Rights Reserved.
			</p>	
		</li>	
	</ul>

	<script>

	document.getElementById('left-sidebar').style.height = window.innerHeight + 'px';

</script>