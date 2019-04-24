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
    <div class="row step-show text-center pt-2 pb-5">
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
        <div class="col-md-3 active">
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

    <p class="text-center">入力された情報をご確認いただき、修正がなければ下部の「確認」ボタンをクリックして下さい。</p>

    <div class="space-sm"></div>

    <div class="info-block m-t-b-20 font-16">
        {{Form::open(['route'=>'register.save_form','method'=>'POST','class'=>'form-horizontal'])}}

            <div class="form-row-h">
                {{Form::label('contact_name','ご担当者様氏名 ')}}
                {{$tempuserData['name'] ? $tempuserData['name'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('zipcode','郵便番号')}}
                {{$tempuserData['zipcode'] ? $tempuserData['zipcode'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('prefecture','都道府県')}}
                {{$tempuserData['prefecture'] ? $tempuserData['prefecture'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('city','市区町村')}}
                {{$tempuserData['city'] ? $tempuserData['city'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('street_address','住所')}}
                {{$tempuserData['street_address'] ? $tempuserData['street_address'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('building','建物名等')}}
                {{$tempuserData['building'] ? $tempuserData['building'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('phone','電話番号')}}
                {{$tempuserData['phone'] ? $tempuserData['phone'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('email','メールアドレス')}}
                {{$tempuserData['email'] ? $tempuserData['email'] : ""}}
            </div>

            <div class="form-row-h">
                {{Form::label('password','パスワード')}}
                ********
            </div>

            <div class="form-row-h">
                {!! Form::label('agree', 'KIDS MEAL Proお よびKIDS MEAL Cameraアプリ利用規約の内容を理解し、同意いたします。',['class'=>'form-row-h-full']) !!}
            </div>

            <div class="form-row-h j-center">
                <div class="d-flex j-center">
                    <a href="#" onclick="window.history.back()" class="border-0 text-white bg-gray btn btn-secondary py-1 px-4 mr-4 btn-register-confirm">戻る</a>
                    
                    <input type="submit" class="border-0 text-white btn btn-warning py-1 px-4 btn-register-confirm" value="確認" align="center">
                </div>
            </div>

        {{Form::close()}}
    </div>

@endsection
