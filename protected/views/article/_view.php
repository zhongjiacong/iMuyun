<table class="ordertable">
	<tbody>
		<?php if(Spreadtable::model()->isProcessed($data->id)): ?>
		<tr class="textview finishtextview">
		<?php else: ?>
		<tr class="textview">
		<?php endif; ?>
			<td>
				<?php
					if(!User::model()->isTranslator())
						echo CHtml::link(CHtml::encode($data->id),array('article/view', 'id'=>$data->id));
					else
						echo CHtml::link(CHtml::encode($data->id),array('article/trans', 'id'=>$data->id));
				?>
			</td>
			<?php /*
				<b><?=CHtml::encode($data->getAttributeLabel('fieldcat_id')); ?>:</b>
				<?=CHtml::encode($data->fieldcat_id); ?>
			*/ ?>
			<td>
				<?=Yii::app()->params['language'][intval($data->srclang_id)].'->'.
					Yii::app()->params['language'][intval($data->tgtlang_id)]; ?>
			</td>
			<td>
				<?=CHtml::encode($data->wordcount); ?>
			</td>
			<td>
				<?php
					date_default_timezone_set("PRC");
					echo date('m-d H:i',strtotime($data->edittime));
				?>
			</td>
			<td>
				<?php if(NULL != Article::model()->comptime($data->id)): ?>
					<?=Time::timeDisplay(Article::model()->comptime($data->id),TRUE); ?>
				<?php endif; ?>
			</td>
			<td>
				<span>
					<?=Spreadtable::model()->isReceived($data->id)?"":
						CHtml::button(Yii::t('article','Receive Article'),array('onclick'=>'receiveart('.$data->id.')')); ?>
				</span>
			</td>
		</tr>
	</tbody>
</table>