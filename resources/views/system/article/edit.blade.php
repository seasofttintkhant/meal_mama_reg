@extends('system.layouts.app')

@section('content')

    {!! Form::model($article, ['route' => ['article.update', $article->id],'files'=>true,'method' => 'PATCH', 'id'=>'create-form']) !!}
    	@include('common.errors')
    	{{ csrf_field() }}
        @include('system.article.form',['edit'=>true, 'categories' => $categories])
    {!! Form::close() !!}
    <div class="eds03_02_btn_area">
        <div class="registration_btn preview-save_btn">
            <a href="#" class="preview-save" id="preview-save" >
            プレビュー
            </a>
        </div>        

        <div class="registration_btn">
                <a href="" id="save">登録</a>
        </div>
        <form action="{{ route('article.delete',$article->id)}}" id="delete-form" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
        </form>

        <div class="delete_btn">
            <a href="#" id="delete">削除</a>
        </div>
    </div>

    <script type="text/javascript">
    
    var myWindow = "";
    var isOpen = false;
        
    function openWindow(url)
    {
        if(!isOpen)
        {
            myWindow = window.open(url, "_blank", "width=420, height=800");
            isOpen = true;
        }
        else
        {
            myWindow.close();
            isOpen = false;
            openWindow(url);
        }
    }
    
    $('#preview-save').click(function(e){
        e.preventDefault();
          CKupdate();
          var data = $('#create-form').serialize();
          var url='{{ route("article.preview_save",$article->id) }}';
            $.ajax({
            data :data,
            type : 'POST',
            url: url,
           }).done(function(data) {
                openWindow("{{ route('article.preview',[$article->category_id,$article->id]) }}");
           });
    });

    function CKupdate(){
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
    }

    </script>
@endsection
