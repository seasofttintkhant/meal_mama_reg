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
    <div class="col-md-3 active">
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
    <div class="col-md-3">
        <h3 class="text-uppercase">Step 4</h3>
        <p>登録受付完了</p>
    </div>
</div>
<!-- STEP SHOW SECTION END -->

<!-- REGISTER FORM START -->
<div class="row register-form justify-content-center py-4">
    <div class="col-md-12">
        <h2 class="text-center">以下のフォームよりご登録に利用される貴園のメールアドレスをご送信ください。</h2>
    </div>
    <div class="col-lg-5">
    {{Form::open(['route'=>'register.save_email','method'=>'POST'])}}
        <div class="input-group">

            {{Form::text('last_name',null,['class'=>'form-control','placeholder' => 'Last Name'])}}
            @if ($errors->has('last_name'))
                <span class="d-block color-red wd100-err-txt">{{ $errors->first('last_name') }}</span>
            @endif
            {{Form::text('first_name',null,['class'=>'form-control','placeholder' => 'First Name'])}}
            @if ($errors->has('first_name'))
                <span class="d-block color-red wd100-err-txt">{{ $errors->first('first_name') }}</span>
            @endif
            {{Form::email('email',null,['class'=>'form-control','placeholder' => '例) kinder@kids‒meal.com'])}}
            <div class="input-group-append">
                <button class="btn btn-warning text-white px-3" type="submit">送信</button>
            </div>
            <br/>
            @if ($errors->has('email'))
                <span class="d-block color-red wd100-err-txt">{{ $errors->first('email') }}</span>
            @endif
        </div>
    {{Form::close()}}
    </div>
</div>
<!-- REGISTER FORM END -->

<!-- LIST SECTION START -->
<div class="row list py-4">
    <div class="col-md-12 px-5">
        <p>注意事項</p>
        <ul>
            <li>ご登録対象は給食を提供されておられる幼稚園、保育園となります。その他の施設、団体、個人の方は別途お問い合わせください。</li>
            <li>既にアカウントをご取得いただいている幼稚園、保育園は重複してご登録いただけません。</li>
            <li>お申込みいただいた後、弊社にて幼稚園・保育園の存在確認、ご登録内容の確認を行なっております。</li>
            <li>弊社の判断によりアカウントの発行をお断りする場合がございます。</li>
            <li>KIDS MEAL Proのアカウント登録およびご利用に関するご質問は"<a href="mailto:info@mealcare.co.jp">info@mealcare.co.jp</a>”までご送信ください。</li>
        </ul>
    </div>
</div>


@endsection

@push('custom_js')

@endpush
