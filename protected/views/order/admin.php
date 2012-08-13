<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
Yii::app()->clientScript->registerScript('order', "
function delorder(id) {
	art.dialog({
		title: '',
        content: '确定要删除么亲？',
	    button: [{
	    	value: '删除',
            callback: function () {
				$.ajax({
					type: 'POST',
					url: '".Yii::app()->request->baseUrl."/index.php/order/delete',
					data: {id: id},
					dataType: 'json',
					beforeSend: function(){},
					success: function(result) {
						if(result.state == 'succeed') {
							art.dialog({title:'',content: '删除成功哦亲^_^',time: 250});
							window.location.reload();
						}
						else
							art.dialog({title:'',content: '删除失败>_<',lock: true,time: 500});
					}
				});
            },
            focus: true
        },
        {
            value: '取消'
        }]
	});
}
",CClientScript::POS_HEAD);
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'subject',
		'customer_id',
		'deadline',
		'audit',
		'submittime',
		'paytime',
		'deliverytime',
		/*
		'invoice_id',
		'express_id',
		'remark',
		'orderstate_id',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array(
		        'view',
		        'update',
		        'delete',
		        /*array(
		            'label'=>'Send an e-mail to this user',
		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
		            'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
		        	'click'=>'function(){delorder('.$data->id.');}',
		        ),*/
		    ),
		),
	),
)); ?>
