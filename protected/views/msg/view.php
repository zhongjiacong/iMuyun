<?php
Yii::app()->clientScript->registerScript('msg', "
	$('#remark').keyup(function(){
		if($('#remark').val() != '')
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	});
	
	$('#redbtn').click(function(){
		var remark = $('#remark').val();
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/msg/update',
			data: {id: ".$model->id.",remark: remark},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed') {
					art.dialog({title:'',content: '".Yii::t('msg','Remark added successfully')."^_^',time: 250});
					function myreload() {
						window.location.reload();
					}
					setTimeout(myreload, 1000);
				}
				else
					art.dialog({title:'',content: '".Yii::t('msg','Remark added failed').">_<',lock: true,time: 500});
			}
		})
	});
	
	$('#modify').toggle(function(){
		$('#msgremarkform').fadeIn('fast');
	},function(){
		$('#msgremarkform').fadeOut('fast');
	});
");
$this->menu=array(
	array('label'=>Yii::t('msg','New Msg'), 'url'=>array('new')),
	array('label'=>Yii::t('msg','My Msg'), 'url'=>array('my'),'visible'=>User::model()->isService()),
	array('label'=>Yii::t('msg','Delete Msg'), 'url'=>'#',
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
		'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>User::model()->isAdmin()),
);
?>

<?php
date_default_timezone_set("PRC");
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label'=>Yii::t('msg','Service Id'),
			'type'=>'raw',
			'value'=>User::model()->getNickname($model->service_id,array('link'=>TRUE)),
			'visible'=>($model->service_id != NULL),/*注意这里的值为空时容易变成显示自己，所以要加上显示限制*/
		),
		'id',
		'name',
		'mobile',
		array(
			'label'=>Yii::t('msg','Email'),
			'type'=>'html',
			'value'=>'<a href="mailto:'.$model->email.'">'.$model->email.'</a>'
		),
		'theme',
		'content',
		array(
			'label'=>Yii::t('msg','Finish Time'),
			'type'=>'datetime',
			'value'=>strtotime($model->finishtime),
			//'value'=>date('Y-m-d H:i:s',strtotime($model->finishtime)),
			'visible'=>($model->finishtime != NULL),
		),
		array(
			'label'=>Yii::t('msg','Remark'),/* 供客服人员查看 */
			'type'=>'raw',
			'value'=>$model->remark.' '.CHtml::button(Yii::t('msg','Modify'),array('id'=>'modify')),
			'visible'=>($model->finishtime != NULL && $model->service_id == Yii::app()->user->getId()),
		),
		array(
			'label'=>Yii::t('msg','Remark'),/* 供其他人员查看 */
			'type'=>'raw',
			'value'=>$model->remark,
			'visible'=>($model->finishtime != NULL && $model->service_id != Yii::app()->user->getId()),
		),
	),
)); ?>

<?php if($model->service_id == Yii::app()->user->getId()): ?>
<div class="form" id="msgremarkform" <?php if($model->finishtime != NULL) { ?>style="display: none;"<?php } ?>>

	<br />
	
	<dl>
		<dt><?=Yii::t('msg','Remark'); ?></dt>
		<dd><?=CHtml::textArea('remark',$model->remark,array('cols'=>60,'rows'=>4)); ?></dd>
	</dl>
	<div>
		<?=CHtml::button(Yii::t('layouts','Save'),array('id'=>'redbtn','disabled'=>'disabled')); ?>
	</div>
</div>
<?php endif; ?>
