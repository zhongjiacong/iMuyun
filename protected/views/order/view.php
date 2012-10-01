<?php
// -- calculate the totalprice start -- //
$totalprice = Order::model()->orderPrice($model->id);
// -- calculate the totalprice end -- //

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Create Order', 'url'=>array('create'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Delete Order',
		'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Order', 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);
?>

<div id="ordertitle">
	<div><span><?=Yii::t('order','ID').' '; ?></span><?=$model->id; ?></div>
	<div><span><?=Yii::t('order','Subject').' '; ?></span><?=$model->subject; ?></div>
	<div><?=CHtml::link(CHtml::button(Yii::t('order','Edit')),array('order/update','id'=>$model->id)); ?></div>
</div>

<div class="paytitle">
	<?=Yii::t('article','Order state').": "; ?>
</div>

<?=$this->renderPartial('state', array('model'=>$model)); ?>

<div class="paytitle">
	<?=Yii::t('article','Order information').": "; ?>
</div>

<table class="ordertable orderpaytable">
	<thead>
		<tr>
			<th><?=Article::model()->getAttributeLabel('id'); ?></th>
			<th><?=Yii::t('article','Language'); ?></th>
			<th><?=Yii::t('article','Word Count'); ?></th>
			<th><?=Yii::t('article','Price'); ?></th>
			<th><?=Yii::t('article','Edit Time'); ?></th>
		</tr>
	</thead>
</table>
<?php
	// 获取当前订单号下的所有文本
	$article = Article::model()->findAll('`order_id` = :order_id',array(':order_id'=>$model->id));
	foreach ($article as $key => $value):
		// 找出所有该文章的句子，组合后存在变量中
		$sentence = Sentence::model()->findAll('`article_id` = :article',
			array(':article'=>$value->id));
		$artcont = "";
		foreach ($sentence as $skey => $svalue) {
			$artcont .= $svalue->original;
		}
?>
<table class="ordertable orderpaytable">
	<tbody>
		<tr>
			<td><?=CHtml::link($value->id,array('article/view','id'=>$value->id)); ?></td>
			<td><?=Yii::app()->params['language'][$value->srclang_id].'->'.Yii::app()->params['language'][$value->tgtlang_id]; ?></td>
			<td><?=$value->wordcount; ?></td>
			<td><?=$value->price; ?></td>
			<td><?=$value->edittime; ?></td>
		</tr>
	</tbody>
</table>
<?php endforeach; ?>

<br />
<br />
<br />
 <div class="form">
 	<dl>
		<dt><?=Yii::t('order','Total Price'); ?></dt>
		<dd>
			<div>￥<?=$totalprice; ?></div>
		</dd>
	</dl>

	<dl>
 		<dt><?=Yii::t('order','Remark'); ?></dt>
 		<dd><?=$model->remark; ?></dd>
 	</dl>
 </div>

<script type="text/javascript">
	$('#redbtn').removeAttr('disabled');
	
	$('#redbtn').click(function(){
		var remark = $('#remark').val();
		$.ajax({
			type: 'POST',
			url: '<?=Yii::app()->request->baseUrl; ?>/order/create',
			data: {id: <?=$model->id; ?>,remark: remark},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed') {
					art.dialog({title:'',content: '<?=Yii::t('order','Pay successfully'); ?>^_^',time: 250});
					function myreload() {
						window.location.reload();
					}
					setTimeout(myreload, 1000);
				}
				else
					art.dialog({title:'',content: '<?=Yii::t('order','Pay failed'); ?>>_<',lock: true,time: 500});
			}
		})
	});
</script>


