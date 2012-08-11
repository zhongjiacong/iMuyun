<?php
	$this->pageTitle=Yii::t('layouts','{appname}',array('{appname}'=>Yii::app()->name)) . ' - Error';
?>

<dl id="infshow">
	<dt><?=Yii::t('site','Error').' '.$code; ?></dt>
	<dd><?php echo CHtml::encode($message); ?></dd>
</dl>