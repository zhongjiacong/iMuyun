<?php
$this->pageTitle=Yii::app()->name . ' - Bussiness';
?>

<div class="pagesHead">Main Bussiness</div>

<div class="intro">
	<div>
		<span>&nbsp;&nbsp;&nbsp;</span><?=Yii::t('layouts','Home'); ?>
		&nbsp;
		<span>&nbsp;&nbsp;&nbsp;</span><?=Yii::t('layouts','Bussiness'); ?>
	</div>
	<div>
		<?=CHtml::image(Yii::app()->theme->baseUrl.'/img/quotewedo.png'); ?>
	</div>
	<div class="title">主营业务——口译、笔译、商务陪同</div>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>覆盖行业</th>
				<th colspan="2">笔译文件类别</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="5">IT 、机械、化工、建筑、金融、医药、<br />
					医疗器械、建材、冶金、仪器仪表、自动化、<br />
					电子、通讯、石油能源、环保、汽车、服装、<br />
					造纸、食品、农牧等。</td>
				<td class="tag">商务贸易类</td>
				<td>金融、保险、人事、财务、市场分析、可行性报告、年度报告、<br />
					公司章程、销售手册、宣传册、公司简介、标书文件、招商资料、<br />
					新闻发布等。</td>
			</tr>
			<tr>
				<td class="tag">工程技术类</td>
				<td>说明书、用户手册、设备安装手册、技术规范、行业标准、科学论文等。</td>
			</tr>
			<tr>
				<td class="tag">法律类</td>
				<td>商业合同、协议、契约、备忘录、法律、法规、条例、管理规定、<br />
					政府公文、上市公司年报、公告、招股说明书、证书、专利资料、<br />
					司法仲裁公文等。 </td>
			</tr>
			<tr>
				<td class="tag">文学类</td>
				<td>影视剧本、散文、诗歌、小说、广告、杂志、海报等。</td>
			</tr>
			<tr>
				<td class="tag">证件类</td>
				<td>录取通知书 、学位证书、 毕业证、 成绩单、 身份证、 驾驶执照、<br />
					护照、营业执照、房产证、资产负债表、营业执照、利润表等。</td>
			</tr>
		</tbody>
	</table>
</div>