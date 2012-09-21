<?php
	// use model's id to judge if registered
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

<script type="text/javascript">
	$('input').keyup(function(){
		var bo = true;
		for(var i = 0; i < 4; i++)
			if($('input').eq(i).val()=='')
				bo = false;
		if(Boolean(bo)==true)
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	});
</script>