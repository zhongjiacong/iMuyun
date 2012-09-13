<?php
Yii::app()->clientScript->registerScript('article',"
	function receiveart(id) {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/article/receive',
			data: {id: id},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed') {
					art.dialog({title:'',content: '".Yii::t('msg','Receive successfully')."^_^',time: 250});
					function myreload() {
						window.location.reload();
					}
					setTimeout(myreload, 1000);
				}
				else
					art.dialog({title:'',content: '".Yii::t('msg','Receive failed').">_<',lock: true,time: 500});
			}
		});
	}
",CClientScript::POS_HEAD);
$this->menu=array(
	array('label'=>Yii::t('article','Manage Article'), 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('article','My Article'), 'url'=>array('my'),
		'visible'=>User::model()->isTranslator()),
);
?>

<table class="ordertable">
	<thead>
		<tr>
			<th></th>
			<th><?=Yii::t('article','Language'); ?></th>
			<th><?=CHtml::encode(Article::model()->getAttributeLabel('wordcount')); ?></th>
			<th><?=Yii::t('article','Edit Time'); ?></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
</table>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>'{items}{summary}<br />{pager}'
)); ?>
