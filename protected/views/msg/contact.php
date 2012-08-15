<?php
Yii::app()->clientScript->registerScript('contact', "
	$('input').keyup(function(){
		var bo = true;
		for(var i = 0; i < 5; i++)
			if($('input').eq(i).val()=='')
				bo = false;
		if(Boolean(bo)==true)
			$('#redbtn').removeAttr('disabled');
		else
			$('#redbtn').attr('disabled','disabled');
	});
");
$this->pageTitle=Yii::t('layouts','{appname}',array('{appname}'=>Yii::app()->name)) . ' - Contact Us';
?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>
	<div class="flash-success">
		<?=Yii::app()->user->getFlash('contact'); ?>
	</div>
<?php else: ?>
	<?=$this->renderPartial('_form', array('model'=>$model)); ?>
<?php endif; ?>