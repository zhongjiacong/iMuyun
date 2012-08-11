<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note"><?=Yii::t('layouts','Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<dl>
		<dt><?php echo $form->labelEx($model,'email'); ?></dt>
		<dd>
			<?php echo $form->textField($model,'email',
				array('size'=>28,'maxlength'=>31)); ?>
			<?php echo $form->error($model,'email'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?php echo $form->labelEx($model,'loginpassword'); ?></dt>
		<dd>
			<?php echo $form->passwordField($model,'loginpassword',array('size'=>28,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'loginpassword'); ?>
		</dd>
	</dl>

    <dl>
        <dt><?=$form->labelEx($model,'repeatpwd'); ?></dt>
        <dd>
        	<?=$form->passwordField($model,'repeatpwd',
	            array('size'=>28,'maxlength'=>40,
	            'title'=>Yii::t('user','Please repeat your password.'))); ?>
	        <?=$form->error($model,'repeatpwd'); ?>
        </dd>
    </dl>

	<dl>
		<dt><?php echo $form->labelEx($model,'mobile'); ?></dt>
		<dd>
			<?=$form->textField($model,'mobile',
				array('size'=>28,'maxlength'=>15,'pattern'=>'[0-9]{11}')); ?>
			<?php echo $form->error($model,'mobile'); ?>
		</dd>
	</dl>

	<div class="row">
		<?php echo $form->hiddenField($model,'enabled',array('value'=>1)); ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('layouts','Register'),
			array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->