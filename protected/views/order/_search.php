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
		<?=$form->label($model,'subject'); ?>
		<?=$form->textField($model,'subject',array('size'=>31,'maxlength'=>31)); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'customer_id'); ?>
		<?=$form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'invoice_id'); ?>
		<?=$form->textField($model,'invoice_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'express_id'); ?>
		<?=$form->textField($model,'express_id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'deadline'); ?>
		<?=$form->textField($model,'deadline'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'audit'); ?>
		<?=$form->textField($model,'audit'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'submittime'); ?>
		<?=$form->textField($model,'submittime'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'paytime'); ?>
		<?=$form->textField($model,'paytime'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'deliverytime'); ?>
		<?=$form->textField($model,'deliverytime'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'remark'); ?>
		<?=$form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'orderstate_id'); ?>
		<?=$form->textField($model,'orderstate_id'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->