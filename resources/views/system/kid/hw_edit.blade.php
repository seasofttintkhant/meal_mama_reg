@extends('system.layouts.app')

@section('content')

{!! Form::model($log, ['route' => ['kid.hw_update',$log->kid_id,$log->id], 'method' => 'PATCH', 'id'=>'create-form']) !!}

        @include('common.errors')
        {{ csrf_field()}}
        <table class="edy11_01_search">
            <tbody><tr>
                <td>
                    <span class="form_title_a">測定日</span>
                    {!! Form::text('date', isset($log->date) && !empty($log->date)? date('Y/m/d', strtotime($log->date)) : '', ['id' => 'datepicker', 'class' => 'input_field_c', 'readonly' => 'readonly']) !!}
                </td>
                <td>
                    <span class="form_title_a">身長(cm)</span>
                    {!! Form::number('height', null, ['class' => 'input_field_a', 'min' => '40']) !!}
                    <span class="form_title_b"> 小数点以下1桁まで</span>
                </td>
                <td>
                    <span class="form_title_a">体重(kg)</span>
                    {!! Form::number('weight', null, ['class' => 'input_field_a', 'min' => '2']) !!}
                    <span class="form_title_b" >小数点以下1桁まで</span>
                </td>
                <td>
                    <span class="form_title_a">メモ</span>
                    {{ Form::textarea('memo', null, ['class' => 'input_field_b', 'cols' => '30', 'rows' => '5']) }}   
                </td>
            </tr>
        </tbody></table>
            <div class="edy11_01_btn_area">
                <div class="save_btn">
                    <a href="#" id="save">保存</a>
                </div>
            </div>
            
{!! Form::close() !!}
@push('custom_js')
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
        } );
    </script>
@endpush

@endsection