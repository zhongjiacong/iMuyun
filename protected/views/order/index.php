<?php
Yii::app()->clientScript->registerScript('order', "
/*function delorder(id) {
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
}*/

function evaluateorder(id) {
	art.dialog({
		title:'',
		content:'".Yii::t('order','Evaluation module will open soon')."^_^',
		lock:false,
		time:1000,
	});
}
",CClientScript::POS_HEAD);
$this->menu=array(
	array(
		'label'=>Yii::t('order','Manage Order'),
		'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()
	),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
