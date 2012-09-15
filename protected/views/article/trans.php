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
?>

<?php
	date_default_timezone_set("PRC");
	
	if($model->filename == NULL) {
		$artcont = "";
		$sentence = Sentence::model()->findAll('`article_id` = :article_id ORDER BY `sentencenum` ASC',
			array(':article_id'=>$model->id));
		foreach ($sentence as $key => $value) {
			$artcont .= $value->original;
		}
	}
	else
		$artcont = CHtml::link($model->filename,Article::model()->fileAddr($model->id,FALSE),
			array('target'=>'_blank'));
	
	$transfile = Article::model()->transFileAddr($model->id,Yii::app()->user->getId());
	$transbtn = !Article::model()->myStart($model->id)?CHtml::button(Yii::t('article','Start Translation'),
			array('id'=>'starttrans','onclick'=>'starttrans();')):
			CHtml::link($transfile["filename"],$transfile["urlpath"]);
	
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			array(
				'label'=>Yii::t('article','Language'),
				'type'=>'raw',
				'value'=>Yii::app()->params['language'][$model->srclang_id].'->'.
					Yii::app()->params['language'][$model->tgtlang_id],
			),
			'edittime',
			array(
				'label'=>Yii::t('article','Complete Time'),
				'type'=>'datetime',
				'value'=>Article::model()->comptime($model->id),
				'visible'=>(NULL != Article::model()->comptime($model->id)),
			),
			array(
				'label'=>Yii::t('article','Article Content'),
				'type'=>'html',
				'value'=>$artcont,
				'visible'=>(NULL != Article::model()->starttime($model->id)),
			),
			array(
				'label'=>Yii::app()->user->getId(),
				'type'=>'raw',
				'value'=>$transbtn,
				'visible'=>Spreadtable::model()->myReceived($model->id),
			),
		),
	));
?>

<?php
	$spreadtable = Spreadtable::model()->findAll("`article_id` = :article_id",array(":article_id"=>$model->id));
	foreach ($spreadtable as $key => $value):
		if($value->translator_id != Yii::app()->user->getId()):
			$transfile = Article::model()->transFileAddr($model->id,$value->translator_id);
			if(Article::model()->starttime($model->id) != NULL):
?>
<div class="form">
	<dl>
		<dt><?=$value->translator_id; ?></dt>
		<dd><?=CHtml::link($transfile["filename"],$transfile["urlpath"]); ?></dd>
	</dl>
</div>
<?php
			endif;
		endif;
	endforeach;
?>

<?php if(Article::model()->myStart($model->id) && !Order::model()->isDelivered($model->id)
	&& Spreadtable::model()->myReceived($model->id)): ?>
<br />
<div class="form">
	<dl>
		<dt><?=Yii::t('sentence','Translation'); ?></dt>
		<dd>
			<form method="post" " action="<?=Yii::app()->request->baseUrl; ?>/index.php/article/comp" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=$model->id; ?>" />
				<input type="file" name="file" />
				<input type="submit" value="<?=Yii::t('article','Complete Translation'); ?>" />
			</form>
		</dd>
	</dl>
</div>
<?php endif; ?>
