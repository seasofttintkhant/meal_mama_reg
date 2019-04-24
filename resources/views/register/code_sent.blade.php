@extends('register.app')
@section('content')

    <!-- MAIN HEADER START -->
    <div class="row main-header">
        <div class="col-md-12 py-4">
            <h1 class="text-centerenter">KIDS MEAL Pro 幼稚園・保育園ユーザー用新規アカウント登録ウィザード</h1>
        </div>
    </div>
    <!-- MAIN HEADER END -->


    <!-- STEP SHOW SECTION START -->
    <div class="row step-show text-center py-4">
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 1</h3>
            <p>メールアドレス登録</p>
            <img src="/img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3 active">
            <h3 class="text-uppercase">Step 2</h3>
            <p>メールアドレス確認</p>
            <img src="/img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 3</h3>
            <p>園情報登録</p>
            <img src="/img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 4</h3>
            <p>登録受付完了</p>
        </div>
    </div>
    <!-- STEP SHOW SECTION END -->

    <div class="info-block m-t-b-20 font-16">
        <p>以下のメールアドレス宛に、メールアドレスの存在確認および園情報登録用のURLをご送信いたしました。</p>
        <p>メールをご確認いただき、手順に沿って貴園の情報をご登録ください。</p>

        <div class="space-sm"></div>
        <p class="text-center">{{$first_name}} {{$last_name}}</p>
        <div class="space-sm"></div>
        <p class="text-center">{{$email}}</p>
        <div class="space-sm"></div>

        <p>メールが届かない場合、スパムフォルダなどに振り分けられていないかご確認ください。</p>
        <p>また "noreply@kids‒meal.jp"からのメールが受信できるように許可してください。</p>

        <div class="space-sm"></div>
        <p class="text-center"><a href="#" class="font-16" onclick="event.preventDefault();document.getElementById('email-form').submit();">メールを再送する</a></p>
    </div>

    <form action="{{route('register.save_email')}}?r=1" style="display:none" method="POST" id="email-form">
        {{csrf_field()}}
        <input type="hidden" name="email" value="{{$email}}">
    </form>
    <div id="dialog-message" title="" style="display:none">
        <p>
            メールを再送いたしました。
        </p>
    </div>

@endsection


@push('custom_js')
<script type="text/javascript">
    $(document).ready(function(){
        @if(isset($_GET['r']) && !empty($_GET['r']) && $_GET['r'] == 1)
            $('#dialog-message').dialog({
                modal: true,
                close: function(){
                    $(this).dialog('close')
                },
                buttons: {
                OK: function() {
                    $(this).dialog('close')
                },
            }
        });
        @endif
    });
</script>
@endpush

