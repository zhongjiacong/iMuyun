<?php
	$this->pageTitle=Yii::t('layouts','{appname}',array('{appname}'=>Yii::app()->name)) . ' - Login';
?>

<br />
<br />
<br />

<?php
Yii::app()->clientScript->registerScript('register', "
	$('input').keyup(function(){
		redbtn();
	});
	
	$('input').focus(function(){
		redbtn();
	});
	
	function redbtn() {
		var bo = true;
		for(var i = 0; i < 2; i++)
			if($('input').eq(i).val()=='')
				bo = false;
		if(Boolean(bo)==true)
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	}
	
	setTimeout(redbtn, 100);
");
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<dl>
		<dt><?=$form->labelEx($model,'username'); ?></dt>
		<dd>
			<?=$form->textField($model,'username',array('size'=>28,'maxlength'=>31)); ?>
			<?=$form->error($model,'username'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'password'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'password',array('size'=>28,'maxlength'=>40)); ?>
			<?=CHtml::link(Yii::t("site","Forgot Password?"),array("/user/forget")); ?>
			<?=$form->error($model,'password'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->checkBox($model,'rememberMe'); ?></dt>
		<dd>
			<?=$form->label($model,'rememberMe'); ?>
			<?=$form->error($model,'rememberMe'); ?>
		</dd>
	</dl>

	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('site','Login'),array('id'=>'redbtn')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
