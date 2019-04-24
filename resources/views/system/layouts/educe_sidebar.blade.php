	<ul id="left-sidebar">	
		<li class="menu-item">
			<i class="fas fa-home"></i>
			<a href="#">HOME</a>
		</li> 
				
		<li class="menu-item">
			<i class="fas fa-bars"></i>
			<a href="#">educe食育記事</a>
			<ul class="inner-menu">
				<li class="inner-menu-list">
					<a href="{{route('article')}}">記事投稿</a>
				</li>
				<li class="inner-menu-list">
					<a href="{{route('article.category')}}">カテゴリー</a>
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