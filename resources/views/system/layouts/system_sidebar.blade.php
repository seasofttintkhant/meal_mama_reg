	<ul id="left-sidebar">	
		<li class="menu-item">
			<i class="fas fa-home"></i>
			<a href="#">HOME</a>
		</li> 
				
		<li class="menu-item">
			<i class="fas fa-bars"></i>
			<a href="#">マスター献立</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("master-menu.index")}}">マスター献立</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("buono.kondate")}}">献立編集</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("buono.kondate.upload")}}">献立CSVインポート</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("recommendation.index")}}">今夜のおすすめ</a>
				</li>
			</ul>
		</li>
				
		<li class="menu-item">
			<i class="fas fa-list-ol"></i>
			<a href="#">献立表・給食だより</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("kondate")}}">献立表</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("kyusyoku")}}">給食だより</a>
				</li>
			</ul>
		</li> 	
			
		<li class="menu-item">
			<i class="fas fa-envelope"></i>
			<a href="#">各種通知</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("system.message")}}">管理者メッセージ</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("notification")}}">お知らせ</a>
				</li>
{{-- 				<li class="inner-menu-list">
					<a href="{{route("camera-notification")}}">お知らせ  (カメラアプリ)</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("message")}}">園のメッセージ</a>
				</li> --}}
			</ul>
		</li>	
			
		<li class="menu-item">
			<i class="fas fa-envelope"></i>
			<a href="#">educe食育記事</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("article")}}">記事投稿</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("article.category")}}">カテゴリー</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("user")}}">educeユーザー</a>
				</li>
			</ul>
		</li>			
						
		<li class="menu-item">
			<i class="fas fa-university"></i>
			<a href="#">園管理</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("kinder")}}">幼稚園・保育園管理</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("kinder_requestlist")}}">園ユーザー登録申請管理</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("kinder_registration_log")}}">園ユーザー登録申請履歴</a>
				</li>
			</ul>
		</li>		
						
		<li class="menu-item">
			<i class="fas fa-university"></i>
			<a href="#">起動時設定</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("setting")}}">KIDS MEALアプリ</a>
				</li>
				{{-- <li class="inner-menu-list">
					<a href="{{route("camera.setting")}}">KIDS MEALカメラ</a>
				</li> --}}
			</ul>
		</li>
						
		<li class="menu-item">
			<i class="fas fa-university"></i>
			<a href="#">Q&A</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route("qa")}}">項目管理</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route("qa.category")}}">カテゴリー</a>
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