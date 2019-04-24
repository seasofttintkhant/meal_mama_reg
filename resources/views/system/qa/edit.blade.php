@extends('system.layouts.app')

@section('content')

    {!! Form::model($qa, ['route' => ['qa.update', $qa->id],'files'=>true,'method' => 'PATCH', 'id'=>'create-form']) !!}
    	@include('common.errors')
    	{{ csrf_field() }}
        @include('system.qa.form',['edit'=>true, 'categories' => $categories])
    {!! Form::close() !!}
    <div class="eds03_02_btn_area">

        <div class="registration_btn">
                <a href="" id="save">登録</a>
        </div>
        <form action="{{ route('qa.delete',$qa->id)}}" id="delete-form" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
        </form>

        <div class="delete_btn">
            <a href="#" id="delete">削除</a>
        </div>
    </div>

    <script type="text/javascript">
    
    function CKupdate(){
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
    }

    </script>
@endsection
