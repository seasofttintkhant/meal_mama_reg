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
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 2</h3>
            <p>メールアドレス確認</p>
            <img src="/img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 3</h3>
            <p>園情報登録</p>
            <img src="/img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3 active">
            <h3 class="text-uppercase">Step 4</h3>
            <p>登録受付完了</p>
        </div>
    </div>
    <!-- STEP SHOW SECTION END -->

    <div class="space-sm"></div>

    <div class="info-block m-t-b-20 font-16">
        <p>KIDS MEAL Pro 幼稚園・保育園ユーザー新規アカウントのご登録を受け付けが完了しました。</p>
        <p>ご登録内容を確認させていただき、2～３営業日以内に以下のご登録メールアドレス宛にご連絡いたします。</p>

        <div class="space-sm"></div>
        <p class="text-center">{{$email}}</p>
        <div class="space-sm"></div>

        <p>申請いただいたご登録内容が確認できない場合は、アカウントの発行をお断りする場合がございます。</p>
        <p>アカウントの発行可否につきまして弊社基準となりますので、発行をお断りした理由等をお答えすることはできません。</p>

        <div class="space-sm"></div>

        <p>なお、３営業日を経過しても弊社からのメールが届かない際には、お手数ですが<a href="mailto:info@mealcare.co.jp">info@mealcare.co.jp</a>まで</p>
        <p>メールにてご連絡いただけますようお願い申し上げます。</p>

    </div>
</div>

    
@endsection

