<?php
$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Article', 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);

Yii::app()->clientScript->registerScript('article', "
	// init tgt lang when page loaded
	$('#Article_tgtlang_id').get(0).selectedIndex = 1;
	
	// accept the terms and enable button
	$('#accept').click(function(){
		if($('#accept').attr('checked') == 'checked')
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	});
	
	// 
	$('#numform1 div:nth-child(2), #numform1 div:nth-child(3)').addClass('shortbg');
	
	$('dl').click(function(){
		// 注意颜色格式
		if($('#'+$(this).attr('class')+' div:nth-child(2)').css('background-color') == 'rgb(204, 204, 204)'){
			$('.numform div:nth-child(2), .numform div:nth-child(3)').removeClass('shortbg');
			$('#'+$(this).attr('class')+' div:nth-child(2)'+', #'+$(this).attr('class')+' div:nth-child(3)').addClass('shortbg');
		}
	});
	
	// update text information if sendkeyup keep unchanged for 2 seconds
	var sendkeyup;
	$('#Article_artcont').keyup(function() {
		clearTimeout(sendkeyup);
		sendkeyup = setTimeout(textinfor,2000);
		$('#wordcount div').html('￥: ...<br />".Yii::t('article','Words').": ...');
	});
	
	// 因为要回调，所以这里写成函数
	function textinfor() {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/article/textinfor',
			data: {srclang_id: $('#Article_srclang_id').val(), content: $('#Article_artcont').val()},
			dataType: 'json',
			beforeSend: function() {},
			success: function(result) {
				$('#wordcount div').html('￥: '+formatFloat(result.price)+'<br />".Yii::t('article','Words').": '+result.wordcount);
			}
		});
	}
	
	$('#textartbtn').click(function(){
		$('#artcontent').html(
			'<textarea rows=\"10\" cols=\"63\" name=\"Article[artcont]\" id=\"Article_artcont\"></textarea>'+
			'<div class=\"errorMessage\" id=\"Article_artcont_em_\" style=\"display:none\"></div>'
		);
		$('#wordcount div').fadeIn('fast');
		// 这里竟然要写回调函数了，坑爹啊
		$('#Article_artcont').keyup(function(){
			clearTimeout(sendkeyup);
			sendkeyup = setTimeout(textinfor,2000);
			$('#wordcount div').html('￥: ...<br />".Yii::t('article','Words').": ...');
		});
	});
	$('#fileartbtn').click(function(){
		$('#artcontent').html(
			'<input id=\"ytArticle_doccont\" type=\"hidden\" value=\"\" name=\"Article[doccont]\">'+
			'<input name=\"Article[doccont]\" id=\"Article_doccont\" type=\"file\"><br />'+
			'<div>Please upload .docx, .txt</div>'+
			'<div class=\"errorMessage\" id=\"Article_doccont_em_\" style=\"display:none\"></div>'
		);
		$('#wordcount div').fadeOut('fast');
	});
	
	$('.textintro span, .textintro div').animate({marginLeft:'100px',opacity:'1'},1500,function(){});
	
	//-- not the same language start --//
	$('#Article_srclang_id').change(function(){
		if(0 == $('#Article_srclang_id').val())
			$('#Article_tgtlang_id').val(1);
		else
			$('#Article_tgtlang_id').val(0);
	});
	$('#Article_tgtlang_id').change(function(){
		if(0 == $('#Article_tgtlang_id').val())
			$('#Article_srclang_id').val(1);
		else
			$('#Article_srclang_id').val(0);
	});
	//-- not the same language end --//
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