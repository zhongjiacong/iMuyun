<div class="artview">

	<?=CHtml::link('<b>'.CHtml::encode($data->getAttributeLabel('id')).':</b>'.
		CHtml::encode($data->id), array('article/view', 'id'=>$data->id)); ?>
	<br />

<?php /*
	<b><?=CHtml::encode($data->getAttributeLabel('fieldcat_id')); ?>:</b>
	<?=CHtml::encode($data->fieldcat_id); ?>
	<br />
*/ ?>

	<b><?=CHtml::encode($data->getAttributeLabel('wordcount')); ?>:</b>
	<?=CHtml::encode($data->wordcount); ?>
	<br />

	<b><?=Yii::t('article','Language'); ?>:</b>
	<?php
		echo Yii::app()->params['language'][intval($data->srclang_id)];
		echo '->';
		echo Yii::app()->params['language'][intval($data->tgtlang_id)];
	?>
	<br />

	<?php if(NULL != Article::model()->comptime($data->id)): ?>
	<b><?=CHtml::encode($data->getAttributeLabel('comptime')); ?>:</b>
	<?=Time::timeDisplay(Article::model()->comptime($data->id),TRUE); ?>
	<?php endif; ?>

</div>