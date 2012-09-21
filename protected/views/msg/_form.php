<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msg-form',
	'enableAjaxValidation'=>TRUE,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<p class="note">
		<?=Yii::t('contact','If you have business inquiries or other questions,
			please fill out the following form to contact us. Thank you.'); ?>
	</p>

	<p class="note"><?=Yii::t('layouts','Fields with <span class="required">*</span> are required.'); ?></p>

	<?=$form->errorSummary($model); ?>

	<dl>
		<dt><?=$form->labelEx($model,'name'); ?></dt>
		<dd>
			<?=$form->textField($model,'name',array('size'=>15,'maxlength'=>15)); ?>
			<?=$form->error($model,'name'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'mobile'); ?></dt>
		<dd>
			<?=$form->textField($model,'mobile',array('size'=>15,'maxlength'=>15)); ?>
			<?=$form->error($model,'mobile'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'email'); ?></dt>
		<dd>
			<?=$form->textField($model,'email',array('size'=>28,'maxlength'=>31)); ?>
			<?=$form->error($model,'email'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'theme'); ?></dt>
		<dd>
			<?=$form->textField($model,'theme',array('size'=>28,'maxlength'=>31)); ?>
			<?=$form->error($model,'theme'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'content'); ?></dt>
		<dd>
			<?=$form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
			<?=$form->error($model,'content'); ?>
		</dd>
	</dl>

	<?php if(CCaptcha::checkRequirements()): ?>
	<dl>
		<dt><?=$form->labelEx($model,'verifyCode'); ?></dt>
		<dd>
			<div>
			<?php $this->widget('CCaptcha'); ?>
			<?=$form->textField($model,'verifyCode'); ?>
			</div>
			<?=$form->error($model,'verifyCode'); ?>
		</dd>
	</dl>
	<div class="hint"><?=Yii::t('contact','Please enter the letters as they are shown in the image above.
	<br/>Letters are not case-sensitive.'); ?></div>
	<?php endif; ?>

	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('layouts','Submit'),
			array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->