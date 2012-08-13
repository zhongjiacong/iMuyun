<div class="clear"></div>

<div class="orderstate<?=($model->paytime != NULL)?' graystate':'';?>">
	<div class="linktriangle">&nbsp;</div>
	<span><?=($model->paytime == NULL)?Yii::t('order','Non-payment'):Yii::t('order','Paid'); ?></span>
</div>
<div class="orderstate<?=($model->audit != 0 || $model->paytime == NULL)?' graystate':'';?>">
	<div class="linktriangle">&nbsp;</div>
	<div class="emptytriangle">&nbsp;</div>
	<span><?=($model->audit == 0)?Yii::t('order','Unaudited'):Yii::t('order','Audited'); ?></span>
	<br />
	审核中若发现订单描述不够明确，会及时联系您确定需求。
</div>
<div class="orderstate<?=($model->deliverytime != NULL || $model->audit == 0)?' graystate':'';?>">
	<div class="emptytriangle">&nbsp;</div>
	<span><?=($model->deliverytime == NULL)?
		Yii::t('order','Translation is not complete'):Yii::t('order','Translation has completed'); ?></span>
</div>

<div class="clear"></div>