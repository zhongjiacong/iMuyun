<?php
	//Friend::model()->findAll('`fans_id` = :id',array(':id'=>Yii::app()->user->getId()));
	Yii::app()->clientScript->registerScript('lang', "
		function dellang(id) {
			$('#langdiv'+id).remove();
		}
	",CClientScript::POS_HEAD);
?>
<div class="form">
	<dl>
		<dt><?=Yii::t('user','Common Language'); ?></dt>
		<dd>
			<div id="langcontainer">
				<?php
					$userlang = Userlang::model()->findAll('`user_id` = :id',array(':id'=>$model->id));
					if(NULL != $userlang){
						foreach ($userlang as $key => $value) {
							echo '<div id="langdiv'.$key.'">'.CHtml::dropDownList(
									'lang'.$key,
									$value->lang_id,
									Yii::app()->params['language'],
									array('class'=>'lang')
								).' '.CHtml::link(
									Yii::t('layouts','Delete'),
									'javascript:void(0);',
									array('onclick'=>'dellang('.$key.');')
								).'</div>';
						}
					}
				?>
			</div>
			<?=CHtml::link(Yii::t('layouts','Add'),'javascript:void(0);',array('id'=>'addlang')); ?>
		</dd>
	</dl>
	
	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('layouts','Save'),array('id'=>'redbtn')); ?>
	</div>
</div>

<?php
	$langArr = Yii::app()->params['language'];
	$langOption = "";
	foreach ($langArr as $key => $value) {
		$langOption .= '<option value="'.$key.'">'.$value.'</option>';
	}
?>
<script type="text/javascript">
	$('#redbtn').click(function(){
		var langsizeflag = $('.lang').size();
		var langArr = new Array();
		// avoid empty lang
		for(var i = 0; i < langsizeflag; i++) {
			if('string' == typeof($('#lang'+i).val()))
				langArr.push($('#lang'+i).val());
			else
				langsizeflag++;
		}
		$.ajax({
			type: 'POST',
			url: '<?=Yii::app()->request->baseUrl; ?>/index.php/user/langupdate',
			data: {lang: $.toJSON(langArr)},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed')
					art.dialog({
						title:'',
						content: '<?=Yii::t('user','Update Language Successfully'); ?>^_^',
						time: 500,
					});
				else
					art.dialog({
						title:'',
						content: '<?=Yii::t('user','Update Language Failed'); ?>>_<',
						lock: true,
						time: 500,
					});
			}
		})
	});
	
	// remember the space before <a>
	$('#addlang').click(function(){
		var langnum = $('.lang').size();
		// avoid empty lang
		for(var i = 0; i < langnum; i++) {
			if('string' != typeof($('#lang'+i).val()))
				langnum++;
		}
		$('#langcontainer').append(
			'<div id="langdiv'+langnum+'">'+
				'<select class="lang" name="lang'+langnum+'" id="lang'+langnum+'"><?=$langOption; ?></select>'+
				' <a onclick="dellang('+langnum+');" href="javascript:void(0);"><?=Yii::t('layouts','Delete'); ?></a>'+
			'</div>'
		);
	});
</script>