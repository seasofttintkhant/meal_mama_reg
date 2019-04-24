<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		html{
			overflow: auto;
		}
		.preview_header{
		  border-bottom: 1px solid #BBAD88;
    	  padding: 15px 0;
		}
		.preview_header_txt{
			color: #BBAD88;
		    font-weight: bold;
		    font-size: 14px;
		    vertical-align: bottom;
		}
		.preview_main{
			margin: 0 2px;
		    position: absolute;
		    top: 100px;
		    z-index: 99999;
		    left: 40px;
		    width: 320px;
		    overflow-y: scroll;
    		overflow-x: hidden;
    		height: 600px;
		}
		.preview_date{
		    float: right;
		    display: block;
		    font-size: 12px;
		}
		.fa-angle-down{
		    font-size: 22px;
		    color: #BBAD88;
		    margin-right: 10px;
		}
		.preview_body{
			margin-top:10px;
		}
		.preview_content{
			font-size: 18px;
		}
		.preview_content_header{
			font-size: 24px;
		}

		.preview_main::-webkit-scrollbar {
		    display: none;
		}
		.mock_up_center{
		 	width:330px;
		 	height:599px;
		 	background:#FFF;
		 }


	</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="_____01" width="400" height="800" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td colspan="3">
			<img src="/img/iphone/iPhone6_Plus_01.jpg" width="400" height="101" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="/img/iphone/iPhone6_Plus_02.jpg" width="37" height="600" alt=""></td>
		<td class="mock_up_center"></td>
		<td>
			<img src="/img/iphone/iPhone6_Plus_04.jpg" width="32" height="600" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="/img/iphone/iPhone6_Plus_05.jpg" width="400" height="100" alt=""></td>
	</tr>
</tbody>
</table>
</body>
</html>

		<div class="preview_main">
			<div class="preview_header">
				
				<span class="preview_header_txt"><i class="fa fa-angle-down" style=""></i><?php echo $article->title;?></span>
			</div>
			<div class="preview_body">
				<small class="preview_date">掲載日: <?php echo date('Y年m月d日',$article->published_date)?></small>
				<br>
				<h2 class="preview_content_header"><?php echo $article->title;?></h2>
				<p class="preview_content"><?php echo $article->content;?></p>
			</div>
		</div>