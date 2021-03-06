<?php
$this->menu=array(
	array('label'=>Yii::t('user','Change Login Password'), 'url'=>array('pwdupdate')),
	array('label'=>Yii::t('user','Delete User'), 'url'=>'#',
		'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>User::model()->isAdmin()),
);
?>
<div class="form">
	<?php if($model->email == Yii::app()->user->name) { ?>
	<p class="note">
		<?php
			echo Yii::t('user','Dear ').Yii::app()->user->name;
			echo '&nbsp;&nbsp;&nbsp;';
			date_default_timezone_set('PRC');
			echo Yii::t('user','Last login time').': '.date("Y-m-d H:i:s",strtotime($model->lastlogintime));
		?>
	</p>
	<?php } ?>
	<dl>
		<dt><?=Yii::t('user','Common Language'); ?></dt>
		<dd>
			<?php
				$userlang = Userlang::model()->findAll('`user_id` = :id',array(':id'=>$model->id));
				foreach ($userlang as $key => $value) {
					echo Yii::app()->params['language'][$value->lang_id];
					if($key != count($userlang) - 1)
						echo ', ';
				}
				echo '<div class="updatelink">'.CHtml::link(Yii::t('layouts','Update'),array('user/langupdate')).'</div>';
			?>
		</dd>
	</dl>
	<hr />
	<?php
		if(User::model()->isAdmin())
			echo '<div class="updatelink">'.CHtml::link(Yii::t('layouts','Update'), array('update','id'=>$model->id)).'</div>';
		else
			echo '<div class="updatelink">'.CHtml::link(Yii::t('layouts','Update'), array('update')).'</div>';
	?>
	<?php if(User::model()->isAdmin()) { ?>
	<dl>
		<dt><?=Yii::t('user','Email'); ?></dt>
		<dd>
			<?=CHtml::encode($model->email); ?>
		</dd>
	</dl>
	<?php } ?>
	<dl>
		<dt><?=Yii::t('user','Account Category'); ?></dt>
		<dd>
			<?=Yii::app()->params['accountcat'][$model->accountcat_id]; ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Nickname'); ?></dt>
		<dd>
			<?=CHtml::encode($model->nickname); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Realname'); ?></dt>
		<dd>
			<?=CHtml::encode($model->realname); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Gender Id'); ?></dt>
		<dd>
			<?=Yii::app()->params['gender'][$model->gender_id]; ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Birthday'); ?></dt>
		<dd>
			<?=CHtml::encode($model->birthday); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Mobile'); ?></dt>
		<dd>
			<?=CHtml::encode($model->mobile); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Telephone'); ?></dt>
		<dd>
			<?=CHtml::encode($model->telephone); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Introduce'); ?></dt>
		<dd>
			<?=CHtml::encode($model->introduce); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Address'); ?></dt>
		<dd>
			<?=CHtml::encode($model->address); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Postcode'); ?></dt>
		<dd>
			<?=CHtml::encode($model->postcode); ?>
		</dd>
	</dl>
	<?php if(User::model()->isAdmin()) { ?>
	<hr />
	<dl>
		<dt><?=Yii::t('user','Privilege Id'); ?></dt>
		<dd>
			<?=Yii::app()->params['privilege'][intval($model->privilege_id)]; ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Verify Code'); ?></dt>
		<dd>
			<?=CHtml::encode($model->verifycode); ?>
		</dd>
	</dl>
	<dl>
		<dt><?=Yii::t('user','Enabled'); ?></dt>
		<dd>
			<?=CHtml::encode($model->enabled); ?>
		</dd>
	</dl>
	<?php } ?>
</div>
