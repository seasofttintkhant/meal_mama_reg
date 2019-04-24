@extends('register.app')
@section('content')

@push('custom_link')
 <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
@endpush
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

    <div class="info-block m-t-b-20 font-16">
        {{Form::open(['route'=>'register.confirm_form','method'=>'POST','class'=>'register-form h-adr'])}}
            <span class="p-country-name" style="display:none;">Japan</span>
            <input type="hidden" name="code" value="{{$code}}">

            <div class="form-row-h form-group row">
                {{Form::label('contact_name','Last Name ',['class'=>'label_required col-md-4 col-form-label'])}}
                <span>{{$last_name}}</span>
                {{Form::hidden('last_name',$last_name)}}
                @if ($errors->has('contact_name'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('contact_name') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('name','First Name',['class'=>'label_required col-md-4 col-form-label'])}}
                <span>{{$first_name}}</span>
                {{Form::hidden('first_name',$first_name)}}
                @if ($errors->has('name'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('zipcode','郵便番号',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::text('zipcode',isset($tempuserData["zipcode"]) && !empty($tempuserData["zipcode"]) ? $tempuserData["zipcode"] : "",['class'=>'col-md-8 form-control p-postal-code', 'placeholder' => '例) 3810003 ','maxlength' =>'7'])}}
                <span class="explantation-label col-md-8 offset-md-4 pl-0">* ハイフン(-)を除いた数字7桁でご入力ください。</span>
                @if ($errors->has('zipcode'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('zipcode') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('prefecture','都道府県',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::select('prefecture',config('prefectures'),null,['class'=>'col-md-8 form-control p-region','placeholder'=> '選択して下さい'])}}
                @if ($errors->has('prefecture'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('prefecture') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('city','市区町村',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::text('city',isset($tempuserData["city"]) && !empty($tempuserData["city"]) ? $tempuserData["city"] : "",['class'=>'col-md-8 form-control p-locality', 'placeholder' => '例) 長野市'])}}
                @if ($errors->has('city'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('city') }}</span>
                @endif
            </div>            

            <div class="form-row-h form-group row">
                {{Form::label('street_address','住所',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::text('street_address',isset($tempuserData["street_address"]) && !empty($tempuserData["street_address"]) ? $tempuserData["street_address"] : "",['class'=>'col-md-8 form-control p-street-address', 'placeholder' => '例) 穂保731番地1'])}}
                @if ($errors->has('street_address'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('street_address') }}</span>
                @endif
            </div>


            <div class="form-row-h form-group row">
                {{Form::label('building','建物名等',['class'=>'col-md-4 col-form-label'])}}
                {{Form::text('building',isset($tempuserData["building"]) && !empty($tempuserData["building"]) ? $tempuserData["building"] : "",['class'=>'col-md-8 form-control'])}}
                @if ($errors->has('building'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('building') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('phone','電話番号',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::text('phone',isset($tempuserData["phone"]) && !empty($tempuserData["phone"]) ? $tempuserData["phone"] : "",['class'=>'col-md-8 form-control','placeholder' => '例) 026‒295‒8800'])}}
                @if ($errors->has('phone'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('email','メールアドレス',['class'=>'label_required col-md-4 col-form-label'])}}
                <span>{{$email}}</span>
                {{Form::hidden('email',$email)}}
                @if ($errors->has('email'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('password','パスワード*',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::password('password',['class'=>'col-md-8 form-control'])}}
                @if ($errors->has('password'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-row-h form-group row">
                {{Form::label('confirm_password','パスワード確認用*',['class'=>'label_required col-md-4 col-form-label'])}}
                {{Form::password('confirm_password',['class'=>'col-md-8 form-control'])}}
                @if ($errors->has('confirm_password'))
                    <span class="color-red d-block h-error col-md-8 offset-md-4 pl-0">{{ $errors->first('confirm_password') }}</span>
                @endif
            </div>

            <div class="form-row-h">
                <ul class="l-style-none">
                    <li>* パスワードは上の2つのフィールドに同じものを入力してください。</li>
                    <li>* パスワードは6文字以上32文字以下で、アルファベット大文字、アルファベット小文字、数字、シンボル（‒ ̲ + $ ! # % @）のうち２種類以上の文字を含む必要があります。</li>
                </ul>
            </div>

            <div class="form-row-h form-check form-check-inline">

                {!! Form::checkbox('agree',null,false,['class'=>'agree form-check-input'])!!}
                {!! Form::label('agree', 'KIDS MEAL Proお よびKIDS MEAL Cameraアプリ利用規約の内容を理解し、同意いたします。',['class'=>'form-row-h-full form-check-label']) !!}
                <span class="color-red agree-error">ご登録申請に際しては、利用規約への同意が必要です。</span>
            </div>

            <div class="form-row-h">
                <div class="terms-of-use-container">
                    <div class="terms-of-use">
                        @include("register.partial_terms_of_use")
                    </div>
                </div>
            </div>

            <div class="form-row-h">
                <input type="submit" class="button button-disabled m-auto submit-register" value="確認" align="center">
            </div>

        {{Form::close()}}
    </div>

@push('custom_js')
        
    <script type="text/javascript">
        $(document).ready(function(){
             if($(".agree").prop("checked") == true){
                $(".agree-error").hide();
                $(".submit-register").removeClass("button-disabled");
            }else{
                $(".submit-register").addClass("button-disabled");
            }

            $(".agree").on("change",function(){
                if($(this).prop("checked") == true){
                    $(".agree-error").hide();
                    $(".submit-register").removeClass("button-disabled");
                }else{
                    $(".submit-register").addClass("button-disabled");
                }
            })

            $(".submit-register").click(function(event){
                event.preventDefault();
                if($(".agree").prop("checked") == false){
                    $(".agree-error").show();
                }else{
                    $(".register-form").submit();
                }
            })
        })
    </script>

@endpush()

@endsection
