<?php
Yii::app()->clientScript->registerScript('article',"
	$('input').keyup(function(){
		if($('input').eq(0).val()!='') {
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
$this->menu=array(
	array('label'=>Yii::t('recharge','List Recharge'), 'url'=>array('index')),
	array('label'=>Yii::t('recharge','Manage Recharge'), 'url'=>array('admin'),'visible'=>User::model()->isAdmin()),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>