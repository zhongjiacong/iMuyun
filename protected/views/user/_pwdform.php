<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note"><?=Yii::t('layouts','Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
	
	<dl>
		<dt><?=$form->labelEx($model,'loginpassword'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'loginpassword',array('size'=>28,'maxlength'=>40)); ?>
			<?=$form->error($model,'loginpassword'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'repeatpwd'); ?></dt>
		<dd>
	        <?=$form->passwordField($model,'repeatpwd',array('size'=>28,'maxlength'=>40,
	            'title'=>Yii::t('user','Please repeat your password.'))); ?>
	        <?=$form->error($model,'repeatpwd'); ?>
		</dd>
	</dl>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ?
			Yii::t('layouts','Create') : Yii::t('layouts','Save'),
			array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->