<?php
// -- calculate the totalprice start -- //
$totalprice = Order::model()->orderPrice($model->id);
// -- calculate the totalprice end -- //

Yii::app()->clientScript->registerScript('orderarticle',"
	function delart(id) {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/article/delete/'+id,
			data: {id: id},
			dataType: 'json',
			beforeSend: function() {},
			success: function(result) {
				if(result.state == 'succeed')
					window.location.reload();
				else if(result.state == 'delorder')
					window.location.href = '".Yii::app()->request->baseUrl."/index.php/order/index';
				else
					art.dialog({
						title:'',
						content: '".Yii::t('article','Article delete failure').">_<',
						time: 1000,
						lock: true,
					});
			}
		});
	}
",CClientScript::POS_HEAD);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index'),'visible'=>User::model()->isAdmin()),
	array('label'=>'Create Order', 'url'=>array('create'),'visible'=>User::model()->isAdmin()),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id),'visible'=>User::model()->isAdmin()),
	array('label'=>'Delete Order',
		'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order', 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
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
	<?=Yii::t('article','Confirm order information').": "; ?>
</div>

<table class="ordertable orderpaytable">
	<thead>
		<tr>
			<th></th>
			<th><?=Yii::t('article','Language'); ?></th>
			<th><?=Yii::t('article','Word Count'); ?></th>
			<th><?=Yii::t('article','Price'); ?></th>
			<th><?=Yii::t('article','Edit Time'); ?></th>
			<th><?=Article::model()->getAttributeLabel('id'); ?></th>
		</tr>
	</thead>
</table>
<?php
	$article = Article::model()->findAll('`order_id` = :order_id',array(':order_id'=>$model->id));
	foreach($article as $key => $value):		
		// 找出所有该文章的句子，组合后存在变量中
		$sentence = Sentence::model()->findAll('`article_id` = :article',
			array(':article'=>$value->id));
		$artcont = "";
		foreach ($sentence as $skey => $svalue) {
			$artcont .= $svalue->original;
		}
		$textinfor = Article::model()->textInfor($value->srclang_id, $artcont);
?>
<table class="ordertable orderpaytable">
	<tbody>
		<tr>
			<td><?=CHtml::link($value->id,array('article/view','id'=>$value->id)); ?></td>
			<td><?=Yii::app()->params['language'][$value->srclang_id].'->'.Yii::app()->params['language'][$value->tgtlang_id]; ?></td>
			<td><?=$textinfor["wordcount"]; ?></td>
			<td><?=$textinfor["price"]; ?></td>
			<td><?=$value->edittime; ?></td>
			<td><?=CHtml::button(Yii::t('layouts','Delete'),array('onclick'=>'delart('.$value->id.');')); ?></td>
		</tr>
	</tbody>
</table>
<?php endforeach; ?>

<br />
<br />
<br />
<div class="form">
	<dl>
		<dt><?=Yii::t('order','Remark'); ?></dt>
		<dd><?=CHtml::textArea('remark',$model->remark,array('cols'=>50,'rows'=>6)); ?></dd>
	</dl>
	
	<dl>
		<dt><?=Yii::t('order','Total Price'); ?></dt>
		<dd>
			<div>￥<?=$totalprice; ?></div>
		</dd>
	</dl>
	
	<dl>
		<dt><?=Yii::t('consume','Available Balance'); ?></dt>
		<dd>
			<div>
				￥<?=Consume::model()->availableBalance(); ?>
				<br />
				<?php
					if(Consume::model()->availableBalance() < $totalprice)
						echo Yii::t("order","Your balance is not enought.").
							Yii::t("order","Please venue {recharge center}.",
								array("{recharge center}"=>CHtml::link(Yii::t("order","recharge center"),array('consume/create'))));
				?>
			</div>
		</dd>
	</dl>
	
	<div>
		<?=CHtml::button(Yii::t('order','Pay'),array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>
</div>

<?php if(Consume::model()->availableBalance() >= $totalprice): ?>
<script type="text/javascript">
	$('#redbtn').removeAttr('disabled');
	
	$('#redbtn').click(function(){
		var remark = $('#remark').val();
		$.ajax({
			type: 'POST',
			url: '<?=Yii::app()->request->baseUrl; ?>/index.php/order/create',
			data: {id: <?=$model->id; ?>,remark: remark},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed') {
					art.dialog({title:'',content: '<?=Yii::t('order','You have successfully payment, please wait for the translation.'); ?>^_^',time: 1500});
					function myreload() {
						window.location.reload();
					}
					setTimeout(myreload, 2000);
				}
				else
					art.dialog({title:'',content: '<?=Yii::t('order','Pay failed'); ?>>_<',lock: true,time: 500});
			}
		})
	});
</script>
<?php endif; ?>