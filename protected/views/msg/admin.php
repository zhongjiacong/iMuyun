<?php
$this->menu=array(
	array('label'=>'List Msg', 'url'=>array('index')),
	array('label'=>'Create Msg', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('msg-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'msg-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'mobile',
		'email',
		'theme',
		'content',
		'service_id',
		/*array(
			'name'=>'finishtime',
			'value'=>'date("Y-m-d H:i",strtotime($model->finishtime))',
		),*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
