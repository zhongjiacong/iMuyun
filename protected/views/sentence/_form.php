<div class="sentenceview">
	<div class="textcolumn"><?=$model->original; ?></div>
	<div class="textcolumn">
		<?=CHtml::textArea('translation'.$model->id,$model->translation,
			array('id'=>'translation'.$model->id,'rows'=>3,'cols'=>40)); ?>
	</div>
	<?=CHtml::button(Yii::t('layouts','Save'),
		array('class'=>'transbtn','onclick'=>'translated('.$model->id.')')); ?>
</div>
