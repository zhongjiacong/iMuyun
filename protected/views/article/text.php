<?php
$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Article', 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);
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
	// $curl = new CUrlManager;
	// echo $curl->getBaseUrl();
	$this->renderPartial('_form', array('model'=>$model));
?>

<script type="text/javascript">
	$('#showterms').click(function(){
		var myDialog = art.dialog();
		jQuery.ajax({
			url: '<?=Yii::app(	)->request->baseUrl; ?>/article/terms',
			success:function(data){
				myDialog.title('<?=Yii::t('article','Terms of Service'); ?>');
				myDialog.content(data);
				myDialog.lock();
				myDialog.button({
					value: '<?=Yii::t('article','Complete reading'); ?>^_^',
					callback: function(){	}
				});
			}
		})
	});
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
	keyupResponse();
	
	// convenient for callback function
	function keyupResponse() {
		$('#Article_artcont').keyup(function() {
			contentResponse();
		});
		$('#Article_artcont').bind('paste',function() {
			contentResponse();
		});
	}
	
	function contentResponse() {
		// textarea height
		var artcontlen = $('#Article_artcont').val().length;
		if(artcontlen > 350)
			document.getElementById("Article_artcont").rows = 10 + (artcontlen - 350) / 40;
		clearTimeout(sendkeyup);
		sendkeyup = setTimeout(textinfor,1000);
		$('#wordcount div').html('￥: ...<br /><?=Yii::t('article','Words'); ?>: ...');
	}
	
	function textinfor() {
		var article_content = $('#Article_artcont').val();
		if("" == article_content) {
			$('#wordcount div').html('￥: 0<br /><?=Yii::t('article','Words'); ?>: 0');
		}
		else {
			$.ajax({
				type: 'POST',
				url: '<?=Yii::app()->request->baseUrl; ?>/article/textinfor',
				data: {srclang_id: $('#Article_srclang_id').val(), content: $('#Article_artcont').val()},
				dataType: 'json',
				beforeSend: function() {},
				success: function(result) {
					$('#wordcount div').html('￥: '+formatFloat(result.price)+'<br /><?=Yii::t('article','Words'); ?>: '+result.wordcount);
				}
			});
		}
	}
	
	$('#textartbtn').click(function(){
		$('#artcontent').html(
			'<textarea rows="10" cols="63" name="Article[artcont]" id="Article_artcont"></textarea>'+
			'<div class="errorMessage" id="Article_artcont_em_" style="display:none"></div>'
		);
		$('#wordcount div').fadeIn('fast');
		// callback function
		keyupResponse();
	});
	
	$('#fileartbtn').click(function(){
		$('#artcontent').html(
			'<input id="ytArticle_doccont" type="hidden" value="" name="Article[doccont]">'+
			'<input name="Article[doccont]" id="Article_doccont" type="file"><br />'+
			'<div><?=Yii::t('article','Please upload'); ?> .doc, .pdf, .docx, .txt, .xls<br />'+
			"<?=Yii::t('article','Max size'); ?> 20M, <?=Yii::t('article',"Please contact us if you can't upload your file"); ?>^_^</div>"+
			'<div class="errorMessage" id="Article_doccont_em_" style="display:none"></div>'
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
		contentResponse();
	});
	$('#Article_tgtlang_id').change(function(){
		if(0 == $('#Article_tgtlang_id').val())
			$('#Article_srclang_id').val(1);
		else
			$('#Article_srclang_id').val(0);
		contentResponse();
	});
	//-- not the same language end --//
</script>