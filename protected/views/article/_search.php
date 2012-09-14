<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?=$form->label($model,'id'); ?>
		<?=$form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'fieldcat_id'); ?>
		<?=$form->textField($model,'fieldcat_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'order_id'); ?>
		<?=$form->textField($model,'order_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'wordcount'); ?>
		<?=$form->textField($model,'wordcount'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'srclang_id'); ?>
		<?=$form->textField($model,'srclang_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'tgtlang_id'); ?>
		<?=$form->textField($model,'tgtlang_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'edittime'); ?>
		<?=$form->textField($model,'edittime'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->