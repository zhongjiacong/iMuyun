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
		<?=$form->label($model,'user_id'); ?>
		<?=$form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'content'); ?>
		<?=$form->textField($model,'content',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'amount'); ?>
		<?=$form->textField($model,'amount',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'audit'); ?>
		<?=$form->textField($model,'audit'); ?>
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