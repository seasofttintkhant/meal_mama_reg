@extends('system.layouts.app')


@section('content')

<form>
	<table class="edy06_01_search">
		<tbody>
			<tr>
				<td nowrap="">
					<span class="form_title_d">タイトル</span>
					<input type="text" class="input_field_c" size="50" name="title" value="{{ isset($_GET['title']) ? $_GET['title'] : ''}}">
							
				</td>
			    <td>
                    <span class="form_title_d">公開/非公開&nbsp;</span><br>

                    <select name="status" class="input_field_a" id="status">
                        <option value="">----</option>
                  		<option value="published">公開</option>
                        <option value="unpublished">非公開</option>
                    </select>
           
			</tr>
			  <tr>
                 <td>
                    <span class="form_title_d">公開日&nbsp;</span><br>
                    <input type="text" class="input_field_c datepicker" name="date_1" readonly value="{{ isset($_GET['date_1']) ? $_GET['date_1'] :'' }}">
                </td> 
                <td>
                    <span class="form_title_d">～&nbsp;</span><br>
                    <input type="text" class="input_field_c datepicker" name="date_2" readonly value="{{ isset($_GET['date_2']) ? $_GET['date_2'] :'' }}">
                </td> 
                <td nowrap="">
                     <input type="submit" value="検索" class="submit_btn">
                     &nbsp;&nbsp;
                	<input id="reset-btn" type="button" value="クリア" class="submit_btn">			
                </td> 
            </tr>
	
		</tbody>
	</table>	
</form>

<span class="page_title">
	educe食育
</span>

<table class="common_tb clear_both inline_table">
    <tbody>
    	<tr class="tr_top">
	        <th class="th_date">記事番号</th>
	        <th class="th_name">記事名</th>
	        <th class="th_name">アイコン画像</th>
	        <th class="th_name"> 公開日</th>
	        <th class="th_title">機能</th>
    	</tr>
    	@if(count($articles)> 0 )
	        @foreach($articles as $article)
	        <tr class="tr_middle">
	            <td class="text_date">{{ $article->id}}</td>
	            <td class="text_name">{{ $article->title }}</td>
	            <td class="text_name"><img src="/img/article/{{ $article->thumbnail }}" style="width: 100px"></td>
	            <td class="text_name">{{ isset($article->date) && !empty($article->date) ? date('Y年n月j日', strtotime($article->date)) :'' }}</td>
	            <td class="text_title">
	                <div class="title_btn_area">
	                    <div class="title_edit_btn">
	                        <a href="{{ route('article.edit', $article->id)}}">編集</a>
						</div>
						<form action="{{ route('article.delete',$article->id)}}" id="article-delete-{{ $article->id}}" method="post">
							{{ csrf_field( )}}
							{{ method_field('DELETE') }}
						</form>
						<div class="title_delivery_btn">
							<a class="delete-button" href="#" data-id="{{ $article->id}}">削除</a>
						</div>
					</div>
	            </td>
	        </tr>
	        @endforeach
    	@endif
	</tbody>
</table>

<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{ route('article.create',$category_id)}}">新規作成</a>
    </div>
</div>

<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>
@push('custom_js')
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
        } );
        </script>

<script type="text/javascript">
	$(document).ready(function(){
		
		@if(isset($_GET['status']) && !empty($_GET['status']))
	    	$('#status').val("{{ $_GET['status'] }}");
	    @endif

		$(".delete-button").click(function(event){
        	event.preventDefault();
        	var id = $(this).data('id');
    	 	$( "#dialog-message" ).dialog({
	      		modal: true,
		      	buttons: {
	        		はい: function() {
			          	$('#article-delete-'+id).submit();
			        },
	        		いいえ: function() {
			          $( this ).dialog( "close" );
			        },
		      	}
		    });
        });

		
	});
</script>
@endpush
@endsection