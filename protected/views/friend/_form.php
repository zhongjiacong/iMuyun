<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'friend-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fans_id'); ?>
		<?php echo $form->textField($model,'fans_id'); ?>
		<?php echo $form->error($model,'fans_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'follow_id'); ?>
		<?php echo $form->textField($model,'follow_id'); ?>
		<?php echo $form->error($model,'follow_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addtime'); ?>
		<?php echo $form->textField($model,'addtime'); ?>
		<?php echo $form->error($model,'addtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->