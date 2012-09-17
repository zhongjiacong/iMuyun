<table class="ordertable servicemsgtable">
	<tbody>
		<tr<?=($data->finishtime == NULL)?' class="grayorder"':''; ?>>
			<td>
				<?=CHtml::link('<b>'.CHtml::encode($data->getAttributeLabel('id')).':</b>'.CHtml::encode($data->id),
					array('view', 'id'=>$data->id)); ?>
			</td>
			<td>
				<?=CHtml::encode($data->name); ?>
			</td>
			<td>
				<?=CHtml::encode($data->theme); ?>
			</td>
			<td>
				<?=CHtml::encode($data->mobile); ?>
			</td>
			<td>
				<span><?=($data->service_id == NULL)?
					CHtml::button(Yii::t('msg','Receive msg'),
					array('class'=>'receivebtn','onclick'=>'receivemsg('.$data->id.')')):
					User::model()->getNickname($data->service_id,array('link'=>TRUE)); ?>
				</span>
			</td>
		</tr>
	</tbody>
</table>