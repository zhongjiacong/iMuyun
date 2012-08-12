<div class="clear"></div>

<div class="orderstate<?=($model->paytime != NULL)?' graystate':'';?>">
	<div class="linktriangle">&nbsp;</div>
	<span><?=($model->paytime == NULL)?Yii::t('order','non-payment'):Yii::t('order','paid'); ?></span>
</div>
<div class="orderstate<?=($model->audit == 0)?' graystate':'';?>">
	<div class="linktriangle">&nbsp;</div>
	<div class="emptytriangle">&nbsp;</div>
	<span><?=($model->audit == 0)?Yii::t('order','unaudited'):Yii::t('order','audited'); ?></span>
	<br />
	审核中若发现订单描述不够明确，会及时联系您确定需求。
</div>
<div class="orderstate<?=($model->deliverytime == NULL)?' graystate':'';?>">
	<div class="emptytriangle">&nbsp;</div>
	<span><?=($model->deliverytime == NULL)?
		Yii::t('order','invoice unsent'):Yii::t('order','invoice sent'); ?></span>
</div>

<div class="clear"></div>