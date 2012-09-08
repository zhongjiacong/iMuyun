<?php
// -- calculate the totalprice start -- //
$totalprice = 0;
// find text whit the same order id
$article = Article::model()->findAll('`order_id` = :order_id',array(':order_id'=>$model->id));
foreach($article as $key => $value) {
	// calculate the totalprice
	$articleprice = Spreadtable::model()->findAll('`article_id` = :id',array(':id'=>$value->id));
	foreach ($articleprice as $pricekey => $pricevalue) {
		$totalprice += $pricevalue->price;
	}
}
// -- calculate the totalprice end -- //

if(Consume::model()->availableBalance() >= $totalprice)
	Yii::app()->clientScript->registerScript('order', "
		$('#redbtn').removeAttr('disabled');
		
		$('#redbtn').click(function(){
			var remark = $('#remark').val();
			$.ajax({
				type: 'POST',
				url: '".Yii::app()->request->baseUrl."/index.php/order/create',
				data: {id: ".$model->id.",remark: remark},
				dataType: 'json',
				beforeSend: function(){},
				success: function(result) {
					if(result.state == 'succeed') {
						art.dialog({title:'',content: '".Yii::t('order','Pay successfully')."^_^',time: 500});
						function myreload() {
							window.location.reload();
						}
						setTimeout(myreload, 1000);
					}
					else
						art.dialog({title:'',content: '".Yii::t('order','Pay failed').">_<',lock: true,time: 500});
				}
			})
		});
	");

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index'),'visible'=>User::model()->isAdmin()),
	array('label'=>'Create Order', 'url'=>array('create'),'visible'=>User::model()->isAdmin()),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id),'visible'=>User::model()->isAdmin()),
	array('label'=>'Delete Order',
		'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>'Manage Order', 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<div id="ordertitle">
	<div><span><?=Yii::t('order','ID').' '; ?></span><?=$model->id; ?></div>
	<div><span><?=Yii::t('order','Subject').' '; ?></span><?=$model->subject; ?></div>
	<div><?=CHtml::link(CHtml::button(Yii::t('order','Edit')),array('order/update','id'=>$model->id)); ?></div>
</div>

<?=$this->renderPartial('state', array('model'=>$model)); ?>

<?php
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
		<div class="form">
			<dl>
				<dt>
					<?=CHtml::link(Article::model()->getAttributeLabel('id').': '.$value->id,
						array('article/view','id'=>$value->id)); ?>
					<br />
					<?=Yii::t('article','Price').': '.$textinfor["price"]; ?>
				</dt>
				<dd>
					<?=Yii::t('article','Language').': '.Yii::app()->params['language'][$value->srclang_id].'->'.
						Yii::app()->params['language'][$value->tgtlang_id]; ?>
					<br />
					<?=Yii::t('article','Word Count').': '.$textinfor["price"]; ?>
					<br />
					<?=$value->edittime; ?>
				</dd>
			</dl>
		</div>
<?php endforeach; ?>

<div class="form">
	<?php if($model->paytime==NULL): ?>
	<dl>
		<dt><?=Yii::t('order','Remark'); ?></dt>
		<dd><?=CHtml::textArea('remark','',array('cols'=>50,'rows'=>6)); ?></dd>
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
						echo Yii::t("order","Your balance is not enought.");
				?>
			</div>
		</dd>
	</dl>
	
	<div>
		<?=CHtml::button(Yii::t('order','Pay'),array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>
	
	<?php else: ?>
	<dl>
		<dt><?=Yii::t('order','Remark'); ?></dt>
		<dd><?=$model->remark; ?></dd>
	</dl>
	<?php endif; ?>
</div>
