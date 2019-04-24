@extends('system.layouts.app')

@section('content')

    @if(isset($link_code))
    <div class="">
        <span class="form_title_a"><b>園連携コード</b></span>
    </div>
    <div class="space-xm"></div>
    <div class="">
        <span class="">KIDS MEALアプリを利用される保護者各位に以下の園連携コードをご共有ください。</span>
    </div>
    
    <table class="e-table_b">
        <tbody>
            <tr>
               
                <td>
                    <span class="form_title_a">
                        <input type="text" name="" value="{{ $link_code }}" class="cus-code e-input_field_a" disabled="">
                    </span>
                </td>
               
                <td>                            
                    <div class="tooltip copy-tooltip">
                        <input class="btn-sbmit-blue cus-copy" value="コピー" type="submit">
                        {{-- <input type="submit" name="" class="sw-submit cus-copy" value="コピー"> --}}
                        <span class="tooltiptext">クリップボードにコピーします</span>
                    </div>
                </td>
            </tr>
             
        </tbody>        
    </table>
    @endif

@endsection

@push('custom_js')
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

    <script type="text/javascript">
        
        $(document).ready(function() {
            
            $(".cus-copy").click(function(event) {
                event.preventDefault();
                var code = $('.cus-code').val().trim();
                $('body').append("<input type='text' class='tak-code' value='"+code+"'>");
                $(".tak-code").select();
                document.execCommand("copy");
                $(".tooltiptext").text("コピーしました");
                $(".tak-code").remove();
            });

            $(".cus-copy").mouseleave(function(event) {
                $(".tooltiptext").text("クリップボードにコピーします");
            });

        });

    </script>

@endpush