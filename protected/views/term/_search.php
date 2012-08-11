<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interpreter_id'); ?>
		<?php echo $form->textField($model,'interpreter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sentence_id'); ?>
		<?php echo $form->textField($model,'sentence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'termnum'); ?>
		<?php echo $form->textField($model,'termnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'original'); ?>
		<?php echo $form->textArea($model,'original',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'translation'); ?>
		<?php echo $form->textArea($model,'translation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'edittime'); ?>
		<?php echo $form->textField($model,'edittime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->