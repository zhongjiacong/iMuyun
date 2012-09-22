<?php
	// use model's id to judge if registered
	if($model->id == NULL):
		echo $this->renderPartial('_regform', array('model'=>$model));
	else:
?>
<dl id="infshow">
	<dt><?=Yii::t('user','Dear ').$model->email.': '; ?></dt>
	<dd>
		<?=Yii::t('user','Congratulations! Registration successful.'.
			' Please check your email and activate your account.'); ?>
	</dd>
</dl>
<br />
<br />
<div class="form">
	<dl>
		<dt>&nbsp;</dt>
		<dd>
			<div class="hint">
				<?=Yii::t('user','If you don\'t receive the email in your inbox, perhaps you can find it in your trash.'); ?><br />
				<?=Yii::t('user','If you can\'t find the email in your trash neither, please call our consume service.'); ?>^_^
			</div>
		</dd>
	</dl>
</div>
<?php endif; ?>

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