$(document).ready(function(){
    var delete_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> 一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？</p>' +'</div>';
    var save_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> 保存しますか？</p>' +'</div>';
    var publish_menu_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> この献立だよりを投稿してもよろしいですか？</p>' +'</div>';
    var publish_school_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> この給食だよりを投稿してもよろしいですか？</p>' +'</div>';
    var send_notification_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> お知らせを送信しますか？</p>' +'</div>';
    var send_message_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> メッセージを送信しますか？</p>' +'</div>';
	
    $("#save").click(function(e){
        
        e.preventDefault();
        var delete_id = $(this).data('id');
      $(save_dialog).dialog({
          modal: true,
            buttons: {
        はい: function() {
                    $('#create-form').submit();
                },
            いいえ: function() {
                  $( this ).dialog( "close" );
                },
            }
        });
    });
    
    $("#delete").click(function(e){
        
        e.preventDefault();
 		$(delete_dialog).dialog({
      		modal: true,
          	buttons: {
        		はい: function() {
                	$('#delete-form').submit();
            	},
        		いいえ: function() {
          			$( this ).dialog( "close" );
            	},
      		}
        });
    });

    $("#publish-menu").click(function(e){
            	
		e.preventDefault();    
 		$(publish_menu_dialog).dialog({
      		modal: true,
      		buttons: {
    			はい: function() {
                	$('#publish-form').submit();
            	},
    			いいえ: function() {
         	 		$( this ).dialog( "close" );
            	},
          	}
    	});
    });
    
    
    $("#publish-school").click(function(e){
            	
    	e.preventDefault();    
     	$(publish_school_dialog).dialog({
      		modal: true,
      		buttons: {
            	はい: function() {
                	$('#publish-form').submit();
            	},
	    		いいえ: function() {
	          			$( this ).dialog( "close" );
	            },
          	}
        });
    });

    $("#send-message").click(function(e){
            	
        e.preventDefault();    
        var type = $(this).data('type');
        if(type == "notification")
        {
        	var dialog = send_notification_dialog;
        }
        else if(type == "message")
        {
        	var dialog = send_message_dialog;
        }
        
     	$(dialog).dialog({
      		modal: true,
          	buttons: {
        		はい: function() {
                	window.location.href= $("#send-message").attr('href');
            	},
        		いいえ: function() {
              		$( this ).dialog( "close" );
        		},
      		}
        });
    });
    
    $("#reset-btn").click(function(e){
       $(this).closest('form').find("input[type=text], textarea").val("");
       $(this).closest('form').find("select option:selected").prop("selected",false);
    	 $(this).closest('form').find("select").val();
    	 $(this).closest('form').find("input[type=checkbox]").removeAttr('checked').removeAttr('selected');
    });
    
    $("#clear").click(function(e){
            	
    	e.preventDefault();    
 		$(publish_dipublish_school_dialogalog).dialog({
  			modal: true,
          	buttons: {
    			はい: function() {
                	window.location.href= $(this).attr('href');
            	},
        		いいえ: function() {
              		$( this ).dialog( "close" );
            	},
      		}
		});
    });
});