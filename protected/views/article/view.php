<?php
Yii::app()->clientScript->registerScript('article',"
	function starttrans() {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/article/start',
			data: {id: ".$model->id."},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed')
					window.location.reload();
				else
					art.dialog({
						title:'',
						content: '".Yii::t('article','Start Translation failed').">_<',
						lock: true,
						time: 500,
					});
			}
		});
	}
	function comptrans() {
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/article/comp',
			data: {id: ".$model->id."},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed')
					window.location.reload();
				else
					art.dialog({
						title:'',
						content: '".Yii::t('article','Complete Translation failed').">_<',
						lock: true,
						time: 500,
					});
			}
		});
	}
	function translated(id) {
		var translation = $('#translation'+id).val();
		$.ajax({
			type: 'POST',
			url: '".Yii::app()->request->baseUrl."/index.php/sentence/update',
			data: {id: id, translation: translation},
			dataType: 'json',
			beforeSend: function(){},
			success: function(result) {
				if(result.state == 'succeed')
					art.dialog({
						title:'',
						content: '".Yii::t('sentence','Save successfully')."^_^',
						time: 500,
					});
				else
					art.dialog({
						title:'',
						content: '".Yii::t('sentence','Save failed').">_<',
						lock: true,
						time: 500,
					});
			}
		})
	}
",CClientScript::POS_HEAD);
$this->menu = array(
	array('label'=>Yii::t('article','List Article'), 'url'=>array('index'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('article','Create Article'), 'url'=>array('text'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('article','Update Article'),
		'url'=>array('update', 'id'=>$model->id),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('article','Delete Article'),
		'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>User::model()->isAdmin()),
	array('label'=>Yii::t('article','Manage Article'), 'url'=>array('admin'),
		'visible'=>User::model()->isAdmin()),
);
?>

<?php
	$transoptbtn = ($model->starttime == NULL)?
		CHtml::button(Yii::t('article','Start Translation'),
			array('id'=>'starttrans','onclick'=>'starttrans();')):
		CHtml::button(Yii::t('article','Complete Translation'),
			array('id'=>'comptrans','onclick'=>'comptrans();'));
	
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
				'value'=>$transoptbtn,
				'visible'=>(NULL == $model->comptime && User::model()->isTranslator()),
			),
			array(
				'label'=>Yii::t('article','Article Content'),
				'type'=>'raw',
				'value'=>Article::model()->getText($model->id),
				'visible'=>(NULL == $model->filename && !User::model()->isTranslator()),
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
				'value'=>strtotime($model->comptime),
				'visible'=>(NULL != $model->comptime),
			),
			array(
				'label'=>Yii::t('article','Translation Content'),
				'type'=>'raw',
				'value'=>(NULL == $model->filename)?Article::model()->getTrans($model->id):
					CHtml::link($model->filename,Article::model()->fileAddr($model->id,FALSE),
					array('target'=>'_blank')),
				'visible'=>(NULL != $model->comptime),
			),
		),
	));

	if($model->starttime != NULL && $model->comptime == NULL && User::model()->isTranslator()) {
		if(NULL == $model->filename) {
			$sentence = Sentence::model()->findAll('`article_id` = :article_id ORDER BY `sentencenum` ASC',
				array(':article_id'=>$model->id));
			foreach ($sentence as $key => $value) {
				echo $this->renderPartial('/sentence/_form', array('model'=>$value));
			}
		}
		else {
?>
<div class="form">
	<dl>
		<dt><?=Yii::t('sentence','Original'); ?></dt>
		<dd><?=CHtml::link($model->filename,Article::model()->fileAddr($model->id,FALSE),
					array('target'=>'_blank')); ?></dd>
	</dl>
	<dl>
		<dt><?=Yii::t('sentence','Translation'); ?></dt>
		<dd>
			<?=CHtml::fileField('trans'); ?>
		</dd>
	</dl>
</div>
<?php
		}
	}
	if($model->comptime != NULL)
		if(NULL == $model->filename) {
			$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'/sentence/_view',
			));
		}
		elseif(User::model()->isTranslator()) {
?>
<div class="form">
	<dl>
		<dt><?=Yii::t('sentence','Original'); ?></dt>
		<dd><?=CHtml::link($model->filename,Article::model()->fileAddr($model->id,FALSE),
					array('target'=>'_blank')); ?></dd>
	</dl>
</div>
<?php } ?>
