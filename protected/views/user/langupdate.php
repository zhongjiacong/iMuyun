<?php
	//Friend::model()->findAll('`fans_id` = :id',array(':id'=>Yii::app()->user->getId()));
Yii::app()->clientScript->registerScript('addlang', "
	$('#redbtn').removeAttr('disabled');

	$('#redbtn').click(function(){
		var langsize = $('.lang').size();
		for(var i = -1; i <= langsize; i++) {
			var flag = (-1 == i)?1:0;
			if(0 == flag)
				flag = (langsize == i)?2:0;
			var lang_id = $('#lang'+i).val();
			$.ajax({
				type: 'POST',
				url: '".Yii::app()->request->baseUrl."/index.php/user/langupdate',
				data: {lang_id: lang_id, flag: flag},
				dataType: 'json',
				beforeSend: function(){},
				success: function(result) {
					if(result.state == 'succeed')
						art.dialog({
							title:'',
							content: '".Yii::t('user','Update Language Successfully')."^_^',
							time: 500,
						});
					else
						art.dialog({
							title:'',
							content: '".Yii::t('user','Update Language Failed').">_<',
							lock: true,
							time: 500,
						});
				}
			});
		}
	});
	$('#addlang').click(function(){
		var langsize = $('.lang').size();
		$('#langcontainer').append('<div class=\"langdiv'+langsize+'\">'+
			'<select class=\"lang\" name=\"lang'+langsize+'\" id=\"lang'+langsize+'\">'+
				'<option value=\"0\">Chinese</option>'+
				'<option value=\"1\">English</option>'+
				'<option value=\"2\">Spanish</option>'+
				'<option value=\"3\">Arabic</option>'+
			'</select> <a onclick=\"dellang(0);\" href=\"javascript:void(0);\">'
			+'".Yii::t('layouts','Delete')."'+'</a></div>');
	});
");
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
			<?php
				echo CHtml::link(Yii::t('layouts','Add'),'javascript:void(0);',
					array('id'=>'addlang'));
			?>
		</dd>
	</dl>
	
	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('layouts','Save'),
			array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>
</div>