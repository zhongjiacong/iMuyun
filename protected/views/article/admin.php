<?php
$this->menu=array(
	array('label'=>Yii::t('article','List Article'), 'url'=>array('index')),
	array('label'=>Yii::t('article','Create Article'), 'url'=>array('text')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?=CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'article-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fieldcat_id',
		'order_id',
		'wordcount',
		'srclang_id',
		'tgtlang_id',
		'comptime',
		'edittime',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
