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
		<?php echo $form->label($model,'fieldcat_id'); ?>
		<?php echo $form->textField($model,'fieldcat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wordcount'); ?>
		<?php echo $form->textField($model,'wordcount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'srclang_id'); ?>
		<?php echo $form->textField($model,'srclang_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgtlang_id'); ?>
		<?php echo $form->textField($model,'tgtlang_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comptime'); ?>
		<?php echo $form->textField($model,'comptime'); ?>
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