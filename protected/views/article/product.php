<?php
Yii::app()->clientScript->registerScript('article',"
	$('#videoimg').click(function(){
		seleprod('video');
	});
	$('#textimg').click(function(){
		seleprod('text');
	});
",CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('seleprod',"
	function seleprod(prod) {
		if($('#autoaccess').attr('checked'))
			$.cookie('SELEPROD',prod,{expires:30,path:'/'});
		window.location.href = '".Yii::app()->request->baseUrl."/index.php/article/'+prod;
	}
",CClientScript::POS_HEAD);
?>

<div class="clear"></div>

<div class="product">
<div><?=Yii::t('article','Video Translation'); ?></div>
<?=CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.'/img/videoprod.png','',
	array('id'=>'videoimg')),'javascript:void(0);'); ?>
</div>

<div class="product">
<div><?=Yii::t('article','Text Translation'); ?></div>
<?=CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.'/img/textprod.png','',
	array('id'=>'textimg')),'javascript:void(0);'); ?>
</div>

<div class="clear"></div>

<br />
<br />

<div class="form">
	<dl>
		<dt>&nbsp;</dt>
		<dd>
			<?=CHtml::checkBox('autoaccess','',array('id'=>'autoaccess')).
				Yii::t('article','Remember my choice next time.').
				Yii::t('article','You can reselect in the settings of your profile.'); ?>
		</dd>
	</dl>
</div>