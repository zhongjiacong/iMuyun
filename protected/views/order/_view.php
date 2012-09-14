<table class="ordertable">
	<tbody>
		<tr<?=($data->deliverytime != NULL)?' class="grayorder"':''; ?>>
			<td><?=CHtml::encode($data->id); ?></td>
			
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
			
			<td><?=Time::timeDisplay($data->submittime); ?></td>
			
			<td><?="￥".Order::model()->orderPrice($data->id); ?></td>
			
			<td>
				<?php
					if($data->paytime == NULL && $data->deliverytime == NULL)
						echo Yii::t('order','Non-payment');
					elseif($data->deliverytime != NULL)
						echo Yii::t('order','Translation has completed')."<br />".CHtml::link(Yii::t('order','Order Detail'),array('view', 'id'=>$data->id));
					else
						echo Yii::t("order","Paid")."<br />".CHtml::link(Yii::t('order','Order Detail'),array('view', 'id'=>$data->id));
				?>
			</td>
			
			<td>
				<?php
					if($data->paytime == NULL){
						echo CHtml::link(CHtml::button(Yii::t('order','Pay')),
							array('pay','id'=>$data->id));
					}
					elseif($data->deliverytime != NULL){
						echo CHtml::button(Yii::t('order','Evaluate'),
							array('onclick'=>'evaluateorder('.$data->id.');'));
					}
				?>
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