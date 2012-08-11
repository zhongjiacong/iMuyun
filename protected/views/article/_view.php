<?php if($data->comptime == NULL): ?>
<div class="textview">
<?php else: ?>
<div class="textview finishtextview">
<?php endif; ?>

	<?=CHtml::link('<b>'.CHtml::encode($data->getAttributeLabel('id')).':</b>'.CHtml::encode($data->id),
		array('article/view', 'id'=>$data->id)); ?>

	<?php /*
		<b><?=CHtml::encode($data->getAttributeLabel('fieldcat_id')); ?>:</b>
		<?=CHtml::encode($data->fieldcat_id); ?>
	*/ ?>

	<b><?=CHtml::encode($data->getAttributeLabel('wordcount')); ?>:</b>
	<?=CHtml::encode($data->wordcount); ?>

	<b><?=Yii::t('article','Language'); ?>:</b>
	<?=Yii::app()->params['language'][intval($data->srclang_id)].'->'.
		Yii::app()->params['language'][intval($data->tgtlang_id)]; ?>
	
	<b><?=Yii::t('article','Edit Time'); ?></b>
	<?=date('m-d H:i',strtotime($data->edittime)); ?>

	<?php if(NULL != $data->comptime) { ?>
	<b><?=CHtml::encode($data->getAttributeLabel('comptime')); ?>:</b>
	<?=Time::timeDisplay($data->comptime); ?>
	<?php } ?>

	<span><?=(Spreadtable::model()->isReceived($data->id) == NULL)?
		CHtml::button(Yii::t('article','Receive Article'),array('onclick'=>'receiveart('.$data->id.')')):
		User::model()->getNickname(Spreadtable::model()->isReceived($data->id),array('link'=>'link')); ?>
	</span>

</div>