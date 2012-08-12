<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note"><?=Yii::t('layouts','Fields with <span class="required">*</span> are required.'); ?></p>

	<?=$form->errorSummary($model); ?>

	<dl>
		<dt><?=$form->labelEx($model,'accountcat_id'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'accountcat_id',Yii::app()->params['accountcat']); ?>
			<?=$form->error($model,'accountcat_id'); ?>
		</dd>
	</dl>

	<?php /*
	<dl>
		<dt><?=$form->labelEx($model,'loginpassword'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'loginpassword',array('size'=>28,'maxlength'=>40)); ?>
			<?=$form->error($model,'loginpassword'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'paypassword'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'paypassword',array('size'=>28,'maxlength'=>40)); ?>
			<?=$form->error($model,'paypassword'); ?>
		</dd>
	</dl>
	*/ ?>

	<dl>
		<dt><?=$form->labelEx($model,'nickname'); ?></dt>
		<dd>
			<?=$form->textField($model,'nickname',array('size'=>28,'maxlength'=>31)); ?>
			<?=$form->error($model,'nickname'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'realname'); ?></dt>
		<dd>
			<?=$form->textField($model,'realname',array('size'=>15,'maxlength'=>15)); ?>
			<?=$form->error($model,'realname'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'gender_id'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'gender_id',Yii::app()->params['gender']); ?>
			<?=$form->error($model,'gender_id'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'birthday'); ?></dt>
		<dd>
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,
					'attribute' => 'birthday',
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
	    				'dateFormat'=>'yy-mm-dd',
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height: 28px;width: 103px;'
				    ),
				));
			?>
			<?=$form->error($model,'birthday'); ?>
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
		<dt><?=$form->labelEx($model,'telephone'); ?></dt>
		<dd>
			<?=$form->textField($model,'telephone',array('size'=>15,'maxlength'=>15)); ?>
			<?=$form->error($model,'telephone'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'introduce'); ?></dt>
		<dd>
			<?=$form->textArea($model,'introduce',array('rows'=>6, 'cols'=>50)); ?>
			<?=$form->error($model,'introduce'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'address'); ?></dt>
		<dd>
			<?=$form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
			<?=$form->error($model,'address'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'postcode'); ?></dt>
		<dd>
			<?=$form->textField($model,'postcode',array('size'=>8,'maxlength'=>6)); ?>
			<?=$form->error($model,'postcode'); ?>
		</dd>
	</dl>

	<dl>
		<dt><?=$form->labelEx($model,'seleprod'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'seleprod',Yii::app()->params['product']); ?>
			<?=$form->error($model,'seleprod'); ?>
		</dd>
	</dl>	
	
	<?php
		if(User::model()->isAdmin() && $model->id != Yii::app()->user->getId()):
			$privilege = Yii::app()->params['privilege'];
			if(!User::model()->isSuper())
				unset($privilege[array_search('Super Administrator', Yii::app()->params['privilege'])]);
	?>
	<hr />
	
	<dl>
		<dt><?=$form->labelEx($model,'privilege_id'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'privilege_id',$privilege); ?>
			<?=$form->error($model,'privilege_id'); ?>
		</dd>
	</dl>
	
	<dl>
		<dt><?=$form->labelEx($model,'loginpassword'); ?></dt>
		<dd>
			<?=$form->passwordField($model,'loginpassword',array('size'=>28,'maxlength'=>40)); ?>
			<?=$form->error($model,'loginpassword'); ?>
		</dd>
	</dl>
	
	<dl>
		<dt><?=$form->labelEx($model,'verifycode'); ?></dt>
		<dd>
			<?=$form->textField($model,'verifycode',array('size'=>20,'maxlength'=>20)); ?>
			<?=$form->error($model,'verifycode'); ?>
		</dd>
	</dl>
	
	<dl>
		<dt><?=$form->labelEx($model,'enabled'); ?></dt>
		<dd>
			<?=$form->dropDownList($model,'enabled',array('Disabled','Enabled')); ?>
			<?=$form->error($model,'enabled'); ?>
		</dd>
	</dl>
	<?php endif; ?>

	<div class="row buttons">
		<?=CHtml::submitButton(Yii::t('layouts','Save'),
			array('disabled'=>'disabled','id'=>'redbtn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->