<?php
Yii::app()->clientScript->registerScript('register', "
	$('input').keyup(function(){
		var bo = true;
		for(var i = 0; i < 4; i++)
			if($('input').eq(i).val()=='')
				bo = false;
		if(Boolean(bo)==true) {
			$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
				$('#redbtn').removeAttr('disabled');
			});
		}
		else {
			$('#redbtn').animate({backgroundColor:'rgb(240,240,240)',color:'rgb(109,109,109)'},250,function(){
				$('#redbtn').attr('disabled','disabled');
			});
		}
	});
");
?>

<?php
	if($model->id == NULL)
		echo $this->renderPartial('_regform', array('model'=>$model));
	else {
?>
	<dl id="infshow">
		<dt><?=Yii::t('user','Dear ').$model->email.': '; ?></dt>
		<dd><?=Yii::t('user','Congratulations! Registration successful.'.
			' Please check your email and activate your account.'); ?></dd>
	</dl>
<?php } ?>