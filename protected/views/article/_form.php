<div class="form">
	
<?php
	// 用于标明步骤
	$counter = 1;
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>TRUE,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?=$form->errorSummary($model); ?>
	
	<?php if(Yii::app()->user->isGuest): ?>
		<div class="numform" id="numform<?=$counter; ?>">
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div><?=Yii::t('article','User registration'); ?></div>
		</div>
		<p class="note"><?=Yii::t('article','You can login and skip this step.'); ?></p>
		<dl class="numform<?=$counter; ?>">
			<dt><?=Yii::t('user','Email'); ?></dt>
			<dd><?=$form->textField($model,'email',array('size'=>23,'maxlength'=>31)); ?></dd>
		</dl>
		<dl class="numform<?=$counter; ?>">
			<dt><?=Yii::t('user','Mobile'); ?></dt>
			<dd><?=$form->textField($model,'mobile',array('size'=>23,'maxlength'=>31)); ?></dd>
		</dl>
	<?php
		$counter++;
		endif;
	?>
	
	<div class="numform" id="numform<?=$counter; ?>">
		<div>&nbsp;</div>
		<div>&nbsp;</div>
		<div><?=$form->labelEx($model,'artcont'); ?></div>
	</div>
	<dl class="numform<?=$counter; ?>">
		<dt><?=Yii::t('article','Original-target Language'); ?></dt>
		<?php
			// supportable languages
			$textlang = Yii::app()->params['language'];
			$textlang = array_splice($textlang,0,2);
		?>
		<dd>
			<?=$form->dropDownList($model,'srclang_id',$textlang,array('class'=>'droplist')); ?>
			<?=$form->dropDownList($model,'tgtlang_id',$textlang,array('class'=>'droplist')); ?>
		</dd>
	</dl>
	<dl class="numform<?=$counter; ?>">
		<dt><?=$form->labelEx($model,'subject'); ?></dt>
		<dd>
			<?php
			// 如果用户未登录，则不需要提供未付款订单主题列表
			if(!Yii::app()->user->isGuest) {
				// 这里不能用empty
				if(Article::model()->getPendingOrder() != array()) {
					$orderList = array(Yii::t('article','New subject'),Yii::t('article','Merge to non-payment subject'));
					echo $form->dropDownList($model,'orderlist',$orderList,
						array('onclick'=>'selectOrderList();','class'=>'droplist'));
				} ?>
				<span id="oldOrderList" class="hide">
					<?=$form->dropDownList($model,'order_id',Article::model()->getPendingOrder(),
						array('class'=>'droplist')); ?>
					<?=$form->error($model,'order_id'); ?>
				</span>
			<?php } ?>
			<span id="newOrderList">
				<?=$form->textField($model,'subject',array('size'=>20,'maxlength'=>31)); ?>
				<?=$form->error($model,'subject'); ?>
			</span>
		</dd>
	</dl>
	<dl class="numform<?=$counter; ?>">
		<dt>
			<div id="wordcount">
				<div>￥0</div>
			</div>
		</dt>
		<dd>
			<b>
				<?=Yii::t('article','Please {entertext} in the text box below, or {uploadfile}.',
					array(
						'{uploadfile}'=>CHtml::link(Yii::t('article','upload file'),'javascript:void(0);',array('id'=>'fileartbtn')),
						'{entertext}'=>CHtml::link(Yii::t('article','enter text'),'javascript:void(0);',array('id'=>'textartbtn')),
					)); ?>
			</b>
			<div id="artcontent">
				<?=$form->textArea($model,'artcont',array('rows'=>10,'cols'=>63)); ?>
				<?=$form->error($model,'artcont'); ?>
			</div>
		</dd>
	</dl>
	<dl class="numform<?=$counter; ?>">
		<dt>&nbsp;</dt>
		<dd>
			<?=CHtml::checkBox('accept',array()).' '.
				Yii::t('article','I accept {terms of service}.',array(
				'{terms of service}'=>CHtml::link('《'.Yii::t('article','Terms of Service').'》',
				array('/site/page','view'=>'terms')))); ?>
		</dd>
	</dl>
	<?php $counter++; ?>

	<?php /*$this->widget( 'ext.EJuiTimePicker.EJuiTimePicker', array(
		'model' => $model, // Your model
		'attribute' => 'deadline', // Attribute for input
	    'options'=>array(
	        'showAnim'=>'fold',
	    	'dateFormat'=>'yy-mm-dd',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'width: 108px;',
	    ),
	));*/ ?>
	
	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ?
			Yii::t('layouts','Submit') : Yii::t('layouts','Save'),
			array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->