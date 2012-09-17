<?php
if(User::model()->isAdmin())
	$this->menu = array(
		array('label'=>Yii::t('article','List Article'), 'url'=>array('index')),
		array('label'=>Yii::t('article','Create Article'), 'url'=>array('text')),
		array('label'=>Yii::t('article','Update Article'),'url'=>array('update', 'id'=>$model->id)),
		array('label'=>Yii::t('article','Delete Article'),
			'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>Yii::t('article','Manage Article'), 'url'=>array('admin')),
);
?>

<?php
	if(NULL != Article::model()->comptime($model->id)) {
		$spreadtable = Spreadtable::model()->findAll("`article_id` = :article_id",array(":article_id"=>$model->id));
		foreach ($spreadtable as $key => $value) {
			if(User::model()->findByPk($value->translator_id)->privilege_id == 6)
				$editor_id = $value->translator_id;
		}
		$transfile = Article::model()->transFileAddr($model->id,$editor_id);
	}
	
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			//'fieldcat_id',
			array(
				'label'=>Yii::t('article','Order'),
				'type'=>'raw',
				'value'=>Order::model()->findByPk($model->order_id)->subject,
			),
			'wordcount',
			array(
				'label'=>Yii::t('article','Language'),
				'type'=>'raw',
				'value'=>Yii::app()->params['language'][$model->srclang_id].'->'.
					Yii::app()->params['language'][$model->tgtlang_id],
			),
			'edittime',
			array(
				'label'=>Yii::t('article','Article Content'),
				'type'=>'raw',
				'value'=>Article::model()->getText($model->id),
			),
			array(
				'label'=>Yii::t('article','Article Content'),
				'type'=>'raw',
				'value'=>CHtml::link($model->filename,Article::model()->fileAddr($model->id,FALSE),
					array('target'=>'_blank')),
				'visible'=>(NULL != $model->filename && !User::model()->isTranslator()),
			),
			array(
				'label'=>Yii::t('article','Complete Time'),
				'type'=>'datetime',
				'value'=>Article::model()->comptime($model->id),
				'visible'=>(NULL != Article::model()->comptime($model->id)),
			),
			array(
				'label'=>Yii::t('article','Translation Content'),
				'type'=>'raw',
				'value'=>CHtml::link($transfile["filename"],$transfile["urlpath"]),
				'visible'=>(NULL != Article::model()->comptime($model->id)),
			),
		),
	));
?>
