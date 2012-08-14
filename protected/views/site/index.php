<?php
Yii::app()->clientScript->registerScript('article', "
	$('body').css('background-image','url(".Yii::app()->theme->baseUrl."/img/bg_long.png)');
	$('#entrance').click(function(){
		if($.cookie('SELEPROD') != null)
			window.location.href = '".Yii::app()->request->baseUrl."/index.php/article/'+$.cookie('SELEPROD');
		else
			window.location.href = '".Yii::app()->request->baseUrl."/index.php/article/product';
	});
",CClientScript::POS_READY);
$this->pageTitle=Yii::t('layouts','{appname}',
	array('{appname}'=>Yii::app()->name));
?>

<div id="slideimg">
	<?=CHtml::link('<div id="entrance">'.Yii::t('site','Start Now').'</div>'); ?>
</div>

<?php /*
<ul>
	<li><?=CHtml::link(Yii::t('site','Quick Translation'),array('article/create')); ?></li>
	<li><?=CHtml::link(Yii::t('site','Document Translation'),array('article/doccreate')); ?></li>
</ul>
*/ ?>

<div id="column">
	<dl>
		<dt><?=Yii::t('layouts','Charge Mode'); ?></dt>
		<dd>
			<ol>
				<li>翻译内容与客户之前已有订单的重复翻译部分不收费。</li>
				<li>翻译内容报价在基本收费基础上，再由系统自动计算难度系数之后，综合反馈给客户。</li>
			</ol>
		</dd>
	</dl>
	
	<dl>
		<dt><?=Yii::t('layouts','Frequently Asked Questions'); ?></dt>
		<dd>
		</dd>
	</dl>
	
	<dl>
		<dt><?=Yii::t('layouts','Contact Information'); ?></dt>
		<dd>
		</dd>
	</dl>
</div>
