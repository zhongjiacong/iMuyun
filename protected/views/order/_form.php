<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<dl>
		<dt><?=$form->labelEx($model,'subject'); ?></dt>
		<dd>
			<?=$form->textField($model,'subject',array('size'=>31,'maxlength'=>31)); ?>
			<?=$form->error($model,'subject'); ?>
		</dd>
	</dl>
	
	<dl>
		<dt><?=$form->labelEx($model,'remark'); ?></dt>
		<dd>
			<?php
				if($model->audit == 0) {
					echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50));
					echo $form->error($model,'remark');
				}
				else {
					echo '['.Yii::t('order','audited').']';
					echo $model->remark;
				}
			?>
		</dd>
	</dl>
	
	<?php if(User::model()->isAdmin() && NULL != $model->paytime): ?>
	<dl>
		<dt><?=$form->labelEx($model,'audit'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'audit',array('Unaudited','Audited')); ?>
			<?=$form->error($model,'audit'); ?>
		</dd>
	</dl>
	<?php endif; ?>

	<?php /*
	<div class="row">
		<?=$form->labelEx($model,'invoice_id'); ?>
		<?=$form->textField($model,'invoice_id'); ?>
		<?=$form->error($model,'invoice_id'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'express_id'); ?>
		<?=$form->textField($model,'express_id'); ?>
		<?=$form->error($model,'express_id'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'deadline'); ?>
		<?=$form->textField($model,'deadline'); ?>
		<?=$form->error($model,'deadline'); ?>
	</div>
	*/ ?>

	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('order','Save'),
			array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->