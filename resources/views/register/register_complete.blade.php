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
            <img src="img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 2</h3>
            <p>メールアドレス確認</p>
            <img src="img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3">
            <h3 class="text-uppercase">Step 3</h3>
            <p>園情報登録</p>
            <img src="img/step_connector.png" alt="Step connector Image">
        </div>
        <div class="col-md-3 active">
            <h3 class="text-uppercase">Step 4</h3>
            <p>登録受付完了</p>
        </div>
    </div>
    <!-- STEP SHOW SECTION END -->


    <div class="row my-4">
        <h2>KIDS MEAL Pro 幼稚園・保育園ユーザー新規アカウントのご登録を受け付けが完了しました。</h2><br>
        <h2>ご登録内容を確認させていただき、2～３営業日以内に以下のご登録メールアドレス宛にご連絡いたします。</h2>
        

        <h2 class="text-center">{{$email}}</h2><br>
        <h2>申請いただいたご登録内容が確認できない場合は、アカウントの発行をお断りする場合がございます。</h2>
        <h2>アカウントの発行可否につきまして弊社基準となりますので、発行をお断りした理由等をお答えすることはできません。</h2><br>
        
        <h2>なお、３営業日を経過しても弊社からのメールが届かない際には、お手数ですが<a href="mailto:info@mealcare.co.jp">info@mealcare.co.jp</a>まで</h2>
        <h2>メールにてご連絡いただけますようお願い申し上げます。</h2>          
    </div>


    
@endsection

