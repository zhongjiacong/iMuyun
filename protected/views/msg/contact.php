<?php
Yii::app()->clientScript->registerScript('contact', "
	$('input').keyup(function(){
		var bo = true;
		for(var i = 0; i < 5; i++)
			if($('input').eq(i).val()=='')
				bo = false;
		if(Boolean(bo)==true) {
			$('#redbtn').animate({backgroundColor:'rgb(204,50,9)',color:'rgb(255,255,255)'},250,function(){
				$('#redbtn').removeAttr('disabled');
			});
		}
		else {
			$('#redbtn').animate({backgroundColor:'rgb(240,240,240)',color:'rgb(109,109,109)'},250,function(){
				$('#redbtn').attr('disabled','disabled');
			});
		}
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