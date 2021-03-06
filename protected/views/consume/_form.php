<div class="form">
	
	<p class="note"><?=Yii::t('user','Dear ').Yii::app()->user->name; ?></p>
	
	<dl>
		<dt><?=Yii::t('consume','Available Balance'); ?></dt>
		<dd>
			￥<?=Consume::model()->availableBalance(); ?>
		</dd>
	</dl>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'consume-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note"><?=Yii::t('layouts','Fields with <span class="required">*</span> are required.'); ?></p>

	<?=$form->errorSummary($model); ?>

	<dl>
		<dt><?=$form->labelEx($model,'amount'); ?></dt>
		<dd>
			<?=$form->textField($model,'amount',
				array('size'=>31,'maxlength'=>31,'onkeyup'=>"if(isNaN(value))execCommand('undo')",
				'onafterpaste'=>"if(isNaN(value))execCommand('undo')")); ?>
			<?=$form->error($model,'amount'); ?>
		</dd>
	</dl>
	
	<?php
		// update (audit) the consume when recharge by admin
		if(User::model()->isAdmin() && Yii::app()->controller->action->id == "update") {
	?>
	<dl>
		<dt><?=$form->labelEx($model,'audit'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'audit',array('Unaudited','Audited')); ?>
			<?=$form->error($model,'amount'); ?>
		</dd>
	</dl>
	<?php } ?>

	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('layouts','Submit'),
			array('id'=>'redbtn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->