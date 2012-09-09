<?php
$this->pageTitle=Yii::t('layouts','{appname}',
	array('{appname}'=>Yii::app()->name));
?>

<br />
<br />
<br />

<?php if(Yii::app()->user->hasFlash("forget")): ?>
	<div class="flash-success">
		<?=Yii::app()->user->getFlash("forget"); ?>
	</div>
<?php endif; ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note"><?=Yii::t('layouts','Fields with <span class="required">*</span> are required.'); ?></p>

	<?=$form->errorSummary($model); ?>
	
	<dl>
		<dt><?=$form->labelEx($model,'loginpassword'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'loginpassword',array('size'=>28,'maxlength'=>31)); ?>
			<?=$form->error($model,'loginpassword'); ?>
		</dd>
	</dl>
	
	<dl>
		<dt><?=$form->labelEx($model,'repeatpwd'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'repeatpwd',array('size'=>28,'maxlength'=>31)); ?>
			<?=$form->error($model,'repeatpwd'); ?>
		</dd>
	</dl>
	
	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('user','Change'),array('id'=>'redbtn')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>