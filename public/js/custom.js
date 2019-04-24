
			// ---------------------------
			// 日付チェック
			// ---------------------------
			function chkDate( datestr ){
				// 正規表現による書式チェック
				if( ! datestr.match( /^\d{4}\/\d{2}\/\d{2}$/ ) ){
					return false;
				}

				var vYear	= datestr.substr( 0, 4 ) - 0;
				var vMonth	= datestr.substr( 5, 2 ) - 1;			// Javascriptは、0-11で表現
				var vDay	= datestr.substr( 8, 2 ) - 0;

				// 月,日の妥当性チェック
				if( vMonth >= 0 && vMonth <= 11 && vDay >= 1 && vDay <= 31 ){
					var vDt = new Date( vYear, vMonth, vDay );
					if(isNaN(vDt)){
						return false;
					}else if( vDt.getFullYear() == vYear && vDt.getMonth() == vMonth && vDt.getDate() == vDay ){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}


			// ---------------------------
			// 削除確認
			// ---------------------------
			function confDel(){
				if( window.confirm( '削除して宜しいですか？' ) ){
					return true;
				}else{
					return false;
				}
			}


			// ---------------------------
			// 確認メッセージ
			// ---------------------------
			function confMsg( msg ){
				if( window.confirm( msg ) ){
					return true;
				}else{
					return false;
				}
			}


			// ---------------------------
			// 表示の折りたたみ
			// ---------------------------
			function showHide( id ){
				var obj = document.getElementById( id );

				obj.style.display = ( obj.style.display == 'none' ) ? '' : 'none';

				return false;
			}


			// ---------------------------
			// エレメント表示
			// ---------------------------
			function showElm( id ){
				var obj = document.getElementById( id );

				obj.style.display = '';

				return false;
			}


			// ---------------------------
			// エレメント非表示
			// ---------------------------
			function hideElm( id ){
				var obj = document.getElementById( id );

				obj.style.display = 'none';

				return false;
			}
			
			function confSend(){
				if( ! confMsg( '配信しますか？' ) )		return false;


				// location.href = sRoot + "/tayori/kondate";

				return false;
			}

			var	sDomain	= "http://kidz-meal.local";
			var	sRoot	= "";


			// ---------------------------
			// 削除確認
			// ---------------------------
			function confDel(){
                if(!confMsg( 'この園を削除しますか？' ) ) return false;
				
				
				location.href = sRoot + "/tayori/kondate";
                return false;
			}

			// ---------------------------
			// 更新確認
			// ---------------------------
			function confSave(){
                if(!confMsg( '保存しますか？' )) return false;
                
                return false;
			}

	