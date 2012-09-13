<?php
$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Article', 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);

Yii::app()->clientScript->registerScript('article', "
	$('#Article_tgtlang_id').get(0).selectedIndex = 1;
	
	$('#accept').click(function(){
		if($('#accept').attr('checked') == 'checked')
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	});
	
	$('#numform1 div:nth-child(2), #numform1 div:nth-child(3)').addClass('shortbg');
	
	$('dl').click(function(){
		// 注意颜色格式
		if($('#'+$(this).attr('class')+' div:nth-child(2)').css('background-color') == 'rgb(204, 204, 204)'){
			$('.numform div:nth-child(2), .numform div:nth-child(3)').removeClass('shortbg');
			$('#'+$(this).attr('class')+' div:nth-child(2)'+', #'+$(this).attr('class')+' div:nth-child(3)').addClass('shortbg');
		}
	});
	
	$('#Article_artcont').keyup(function() {
		textinfor();
	});
	
	// 因为要回调，所以这里写成函数
	function textinfor() {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/article/textinfor',
			data: {srclang_id: $('#Article_srclang_id').val(), content: $('#Article_artcont').val()},
			dataType: 'json',
			beforeSend: function() {
				//$('#wordcount div').html('￥...');
			},
			success: function(result) {
				$('#wordcount div').html('￥'+formatFloat(result.price));
			}
		});
	}
	
	$('#textartbtn').click(function(){
		$('#artcontent').html(
			'<textarea rows=\"10\" cols=\"63\" name=\"Article[artcont]\" id=\"Article_artcont\"></textarea>'+
			'<div class=\"errorMessage\" id=\"Article_artcont_em_\" style=\"display:none\"></div>'
		);
		// 这里竟然要写回调函数了，坑爹啊
		$('#Article_artcont').keyup(function(){
			textinfor();
		});
	});
	$('#fileartbtn').click(function(){
		$('#artcontent').html(
			'<input id=\"ytArticle_doccont\" type=\"hidden\" value=\"\" name=\"Article[doccont]\">'+
			'<input name=\"Article[doccont]\" id=\"Article_doccont\" type=\"file\"><br />'+
			'<div>Please upload .docx, .txt</div>'+
			'<div class=\"errorMessage\" id=\"Article_doccont_em_\" style=\"display:none\"></div>'
		);
	});
	
	$('.textintro span, .textintro div').animate({marginLeft:'100px',opacity:'1'},1500,function(){});
");
Yii::app()->clientScript->registerScript('textform', "
	function selectOrderList() {
		if($('#Article_orderlist').val() == 0) {
			$('#oldOrderList').addClass('hide');
			$('#newOrderList').removeClass('hide');
		}
		else {
			$('#newOrderList').addClass('hide');
			$('#oldOrderList').removeClass('hide');
		}
	}
	
	function formatFloat(flt) {
		if(parseFloat(flt) == flt)
			return Math.round(flt * 10000) / 10000;
		else
			return 0;
	}
",CClientScript::POS_HEAD);
?>

<div class="textintro">
	<div><?=Yii::t('layouts','MuYun Translation'); ?></div>
	<span>be of your service</span>
</div>
<?php if(Yii::app()->user->hasFlash("text")): ?>
	<div class="flash-success">
		<?=Yii::app()->user->getFlash("text"); ?>
	</div>
<?php
	endif;
	$this->renderPartial('_form', array('model'=>$model));
?>