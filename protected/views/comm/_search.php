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
		<?php echo $form->label($model,'sender_id'); ?>
		<?php echo $form->textField($model,'sender_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiver_id'); ?>
		<?php echo $form->textField($model,'receiver_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'msg'); ?>
		<?php echo $form->textField($model,'msg',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sendtime'); ?>
		<?php echo $form->textField($model,'sendtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'read'); ?>
		<?php echo $form->textField($model,'read'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->