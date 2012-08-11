<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'accountcat_id',
		'privilege_id',
		'email',
		//'loginpassword',
		//'paypassword',
		'nickname',
		'realname',
		'gender_id',
		'birthday',
		'mobile',
		'telephone',
		'introduce',
		'address',
		'postcode',
		'enabled',
		//'verifycode',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
