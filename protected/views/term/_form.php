<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'interpreter_id'); ?>
		<?php echo $form->textField($model,'interpreter_id'); ?>
		<?php echo $form->error($model,'interpreter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sentence_id'); ?>
		<?php echo $form->textField($model,'sentence_id'); ?>
		<?php echo $form->error($model,'sentence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'termnum'); ?>
		<?php echo $form->textField($model,'termnum'); ?>
		<?php echo $form->error($model,'termnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original'); ?>
		<?php echo $form->textArea($model,'original',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'original'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textArea($model,'translation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'translation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edittime'); ?>
		<?php echo $form->textField($model,'edittime'); ?>
		<?php echo $form->error($model,'edittime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->