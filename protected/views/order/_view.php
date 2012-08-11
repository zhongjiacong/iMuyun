<div class="orderview">
	
	<table>
		<thead>
			<tr>
				<th><?=CHtml::encode($data->getAttributeLabel('id')); ?></th>
					
				<th><?=CHtml::encode($data->getAttributeLabel('subject')); ?></th>
				
				<th><?=Yii::t('order','Order Text'); ?></th>
				
				<?php if($data->deadline != $data->submittime): ?>
				<th><?=Time::timeDisplay($data->deadline); ?></th>
				<?php endif; ?>
				
				<th><?=CHtml::encode($data->getAttributeLabel('submittime')); ?></th>
				
				<?php if($data->deliverytime != NULL): ?>
				<th><?=CHtml::encode($data->getAttributeLabel('deliverytime')); ?></th>
				<?php endif; ?>
				
				<?php if($data->remark != ""): ?>
				<th><?=CHtml::encode($data->getAttributeLabel('remark')); ?></th>
				<?php endif; ?>
				
				<th><?=Yii::t('order','Order Operation'); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=CHtml::link(CHtml::encode(CHtml::encode($data->id)),
					array('view', 'id'=>$data->id)); ?></td>
				
				<td><?=CHtml::encode($data->subject); ?></td>
				
				<td>
					<?php
						// 输出订单下的所有文章
						$article = Order::model()->getArticle($data->id);
					    $dataProvider=new CActiveDataProvider('Article', array(
					        'criteria'=>array(
					        	'order'=>'`id` DESC',
					            'condition'=>'`order_id` = '.$data->id,
					        ),
					        'pagination'=>array('pageSize'=>10),
						));
						$this->widget('zii.widgets.CListView', array(
							'dataProvider'=>$dataProvider,
							'itemView'=>'/article/_item',
							'template'=>'{items}{pager}',
						));
					?>
				</td>
				
				<?php if($data->deadline != $data->submittime) { ?>
				<td><?=Time::timeDisplay($data->deadline); ?></td>
				<?php } ?>
				
				<td><?=Time::timeDisplay($data->submittime); ?></td>
				
				<?php if($data->deliverytime != NULL): ?>
				<td><?=Time::timeDisplay($data->deliverytime); ?></td>
				<?php endif; ?>
				
				<?php if($data->remark != ""): ?>
				<td><?=CHtml::encode($data->remark); ?></td>
				<?php endif; ?>
				
				<td>
					<?php if($data->paytime == NULL): ?>
						<?=CHtml::link(CHtml::button(Yii::t('order','Pay')),array('pay','id'=>$data->id)); ?>
					<?php else: ?>
					<?=CHtml::button(Yii::t('order','Evaluate'),array('onclick'=>'evaluateorder('.$data->id.');')); ?>
					<?php
						if(User::model()->isAdmin())
							echo CHtml::button(Yii::t('order','Delete'),array('onclick'=>'delorder('.$data->id.');'));
					?>
					<?php endif; ?>
				</td>
			</tr>
		</tbody>
	</table>
	
	<?php /*
		<b><?=CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
		<?=CHtml::encode($data->invoice_id); ?>
		<br />
	
		<b><?=CHtml::encode($data->getAttributeLabel('express_id')); ?>:</b>
		<?=CHtml::encode($data->express_id); ?>
		<br />
	
		<b><?=CHtml::encode($data->getAttributeLabel('audit')); ?>:</b>
		<?=CHtml::encode($data->audit); ?>
		<br />
	
		<b><?=CHtml::encode($data->getAttributeLabel('orderstate_id')); ?>:</b>
		<?=CHtml::encode($data->orderstate_id); ?>
		<br />
	*/ ?>

</div>