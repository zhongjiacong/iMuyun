<?php
Yii::app()->clientScript->registerScript('msg', "
	function receivemsg(id) {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/msg/receive',
			data: {id : id},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result){
				if(result.state == 'succeed') {
					art.dialog({title:'',content: '".Yii::t('msg','Receive successfully')."^_^',time: 250});
					function myreload() {
						window.location.reload();
					}
					setTimeout(myreload, 1000);
				}
				else {
					art.dialog({title:'',content: '".Yii::t('msg','Receive failed').">_<',lock: true,time: 500});
				}
			}
		});
	}
",CClientScript::POS_HEAD);
$this->menu=array(
	array('label'=>Yii::t('msg','New Msg'), 'url'=>array('new')),
	array('label'=>Yii::t('msg','My Msg'), 'url'=>array('my'),
		'visible'=>User::model()->isService()),
);
?>

<table class="ordertable servicemsgtable">
	<thead>
		<th></th>
		<th><?=CHtml::encode(Msg::model()->getAttributeLabel('name')); ?></th>
		<th><?=CHtml::encode(Msg::model()->getAttributeLabel('theme')); ?></th>
		<th><?=CHtml::encode(Msg::model()->getAttributeLabel('mobile')); ?></th>
		<th></th>
	</thead>
</table>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>'{items}{summary}<br />{pager}'
)); ?>
