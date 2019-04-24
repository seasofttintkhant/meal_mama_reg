@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

@section('content')

<span class="page_title">
	園ユーザー登録申請管理
</span>
<br>

<div class="row">
	<div class="col col-right">
		<div class="col_inner">
			<table class="common_tb clear_both inline_table auto_width bold_table">
				<tbody>
					<tr class="tr_top">
						<th class="th_no pd_010">ID</th>
						<th class="th_name pd_020">名称</th>
						<th class="th_city pd_020">市区町村〜番地</th>
						<th class="th_email">メールアドレス</th>
						<th class="th_operation pd_020">登録申請日時</th>
						<th class="th_operation pd_020">操作</th>
					</tr>
					
						@foreach($tempusers as $tempuser)
							<tr class="tr_middle">
								<td class="td_border">{{ $tempuser->id}}</td>
								<td class="td_border">{{ $tempuser->name}}</td>
								<td class="td_border pd_020">{{$tempuser->city}}</td>
								<td class="td_border pd_020">{{$tempuser->email}}</td>
								<td class="td_border pd_020">{{isset($tempuser->created_at) && !empty($tempuser->created_at) ? date('Y年m月d日 H:i',$tempuser->created_at->timestamp) : ""}}</td>
								<td class="text_title h_40px">    
									<div class="btn-wrapper">
										<div class="title_edit_btn">
			                                <a href="{{ route('kinder_request.show',$tempuser->id) }}" class="eye_btn"><i class="fa fa-btn fa-eye"></i> 詳細を見る
			                                </a>
			                            </div>
									</div>
								</td>
							</tr>
						@endforeach
				</tbody>
			</table>
			
		</div>
	</div>
</div>
@endsection
