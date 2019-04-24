<?php 
	use App\Kinder;
	$group = \Auth::user()->group;
?>

<!--GNAV-->
 	<ul id="gnav">
		<?php if($group == 2) :?>
		
		<li class="gnav_02 drop-down">
			<a href="#">カメラアプリ</a>
			<ul class="drop-down-content">
				<li class="gnav_08">
					<a href="{{route('camera.setting')}}">起動時設定</a>
				</li>
				<li class="gnav_12">
					<a href="{{ route('camera.notification')}}">お知らせ</a>
				</li> 
			</ul>
		</li> 
			
		<li class="gnav_08 drop-down">
			<a href="{{route('setting')}}">アプリ起動時設定</a>
			<ul class="drop-down-content">
				<li class="gnav_12">
					<a href="{{route('various.settings')}}">各種設定</a>
				</li>
			</ul>
		</li>
		
		
		<?php endif;?>
		
		<?php if($group != 1) :?>
		<li class="gnav_11">
			<a href="{{route('push.message')}}">プッシュ通知</a>
		</li>
		
			<?php if($group == 0): ?> 
				<li class="gnav_06">
					<a href="{{route('user_detail.index')}}">園連携ユーザー一覧</a>
				</li>
			<?php endif ?>

		<li class="gnav_02 drop-down">
			<a href="#">通知管理</a>
			<ul class="drop-down-content">
				<li class="gnav_11">
					<a href="{{route('system.message')}}">管理者メッセージ</a>
				</li>
				<li class="gnav_12">
					<a href="{{route('notification')}}">お知らせ</a>
				</li> 

				<li class="gnav_13">
					<a href="{{route('message')}}">メッセージ</a>
				</li>
		
			</ul>
		</li> 

		{{--  <li class="gnav_02">
			<a href="/learning">ｅラーニング管理</a>
		</li>  --}}
		
		<li class="gnav_10 drop-down">
			<a href="#">お便り管理</a>
			<ul class="drop-down-content">
				<li class="gnav_04">
					<a href="{{route('kondate')}}">献立だより管理</a>
				</li>

				<li class="gnav_01">
					<a href="{{route('kyusyoku')}}">給食だより管理</a>
				</li>
			</ul>
		</li>
		<?php endif;?>

		<?php if($group == 1):?>
			<li class="gnav_04">
				<a href="{{route('mypage')}}">educeユーザ管理</a>
			</li>
		<?php endif;?>
		
		<?php if($group == 1 || $group == 2) :?>
			
			<li class="gnav_05 drop-down">
				<a href="#">educe管理</a>
				<ul class="drop-down-content">
					<li class="gnav_04">
						<a href="{{ route('article')}}">educe食育</a>
					</li>
					<li class="gnav_06">
						<a href="{{ route('article.category')}}">educe食育コラム</a>
					</li>
					<?php if($group == 2) :?>
					<li class="gnav_07">
						<a href="{{route('user')}}">educeユーザ管理</a>
					</li>
				
					<?php endif;?>
				</ul>
			</li>
			
		<?php endif;?>

		<?php if($group == 2) :?>
			<li class="gnav_05 drop-down">
				<a href="{{route('qa')}}">Q&A</a>
				<ul class="drop-down-content">
					<li class="gnav_04">
						<a href="{{ route('qa.category')}}">Q&Aカテゴリー</a>
					</li>
				</ul>
			</li>
			
		<?php endif;?>
		

		<?php if($group != 1) :?>
		<li class="gnav_03 drop-down">
			<a href="#">献立管理</a>
			<ul class="drop-down-content">
				<li class="gnav_04">
					<a href="{{route('buono.kondate')}}">献立編集</a>
				</li>
				<?php if($group == 2 || ( $group != 1 && $kinder->canUploadMenu() )) :?>
				<li class="gnav_06">
					<a href="{{route('buono.kondate.upload')}}">データ連携</a>
				</li>
				<?php endif;?>

				<?php if($group==0):?>
					<li class="gnav_01">
						<a href="{{route('kinder-menu.index')}}">今日の献立</a>
					</li>
				<?php endif;?>

				<?php if($group==2):?>
					<li class="gnav_01">
						<a href="{{route('recommendation.index')}}">今日のおすすめ</a>
					</li>
					<li class="gnav_04">
						<a href="{{route('master-menu.index')}}">マスター献立</a>
					</li>
				<?php endif;?>

				<?php if($group == 0) :?>
					<li class="gnav_13">
						<a href="{{route('nutrition')}}">栄養評価基準</a>
					</li>
				<?php endif;?>
			</ul>
		</li>
		
		<?php endif;?>
	</ul>
<!--GNAV-->