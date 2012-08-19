<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="shortcut icon" href="<?=Yii::app()->theme->baseUrl; ?>/img/favicon.ico" type="image/x-icon" >

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/layouts.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/view.css" />
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->theme->baseUrl; ?>/css/menu.css" />
    <link id="artDialog-skin" rel="stylesheet" type="text/css"
        href="<?=Yii::app()->theme->baseUrl; ?>/js/artDialog/skins/green.css" />

	<title><?=CHtml::encode($this->pageTitle); ?></title>

    <script type="text/javascript" src="<?=Yii::app()->theme->baseUrl; ?>/js/jquery.animate-colors-min.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->theme->baseUrl; ?>/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->theme->baseUrl; ?>/js/syscookie.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->theme->baseUrl; ?>/js/view.js"></script>
    <?php
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->theme->baseUrl.'/js/artDialog/artDialog.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->theme->baseUrl.'/js/artDialog/artDialog.plugins.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScript('clock','
			setInterval( function() {
				var seconds = new Date().getSeconds();
				var sdegree = seconds * 6;
				var srotate = "rotate(" + sdegree + "deg)";
				$("#sec").css({
					"-moz-transform" : srotate,
					"-webkit-transform" : srotate,
					"transform" : srotate,
					"-ms-transform" : srotate,
					"-o-transform" : srotate,
				});
			}, 1000 );

			setInterval( function() {
				var hours = new Date().getHours();
				var mins = new Date().getMinutes();
				var hdegree = hours * 30 + (mins / 2);
				var hrotate = "rotate(" + hdegree + "deg)";
				$("#hour").css({
					"-moz-transform" : hrotate,
					"-webkit-transform" : hrotate,
					"transform" : hrotate,
					"-ms-transform" : hrotate,
					"-o-transform" : hrotate,
				});
			}, 1000 );

			setInterval( function() {
				var mins = new Date().getMinutes();
				var mdegree = mins * 6;
				var mrotate = "rotate(" + mdegree + "deg)";
				$("#min").css({
					"-moz-transform" : mrotate,
					"-webkit-transform" : mrotate,
					"transform" : mrotate,
					"-ms-transform" : mrotate,
					"-o-transform" : mrotate,
				});
			}, 1000 );
		');
	?>

</head>

<body>

<div class="container">
	<div id="headerline">&nbsp;</div>
	<div id="header">
		<div id="headright">
			<ul id="clock">	
			   	<li id="sec"></li>
			   	<li id="hour"></li>
				<li id="min"></li>
			</ul>
			<div id="syslangdiv">
				<?php
					$syslang = array(
						'zh_cn'=>'中文',
						'en_us'=>'English',
					);
					Yii::app()->clientScript->registerScript('language', "
						$('#syslang').change(function(){
							langSwitch($('#syslang').val());
						});
					");
					echo CHtml::dropDownList('syslang', isset($_COOKIE['SYSLANG'])?$_COOKIE['SYSLANG']:'zh_cn', $syslang);
					//echo $_SERVER['QUERY_STRING'];
				?>
			</div>
			<div id="login">
				<?php
					if(!Yii::app()->user->isGuest) {
						echo Yii::t('layouts','Hello, ').
							CHtml::link(Yii::app()->user->name,array('/user/view','id'=>Yii::app()->user->getId()));
						echo ' | ';
						echo CHtml::link(Yii::t('layouts','Logout'),array('/site/logout'));
					}
					else
						echo CHtml::link(Yii::t('layouts','Login'),array('/site/login'));
					echo ' | ';
					echo CHtml::link(Yii::t('layouts','Register'),array('/user/register'));
				?>
			</div>
		</div>
		<?php
			Yii::app()->clientScript->registerScript('header', "
				$('#headleft').click(function(){
					window.location.href = '".Yii::app()->request->baseUrl."/index.php/site/index';
				});
			");
		?>
		<div id="headleft">
			<div id="logoimgdiv">
				<?=CHtml::image(Yii::app()->theme->baseUrl.'/img/logoimg.jpg','Logo Image'); ?>
			</div>
			<div id="logo">
				牧云翻译
				<span>Muyun Translation</span>
			</div>
		</div>
		<div id="mainmenu">
			<?php
				if(!(Yii::app()->controller->id == 'site' &&
					Yii::app()->controller->action->id == 'index') &&
					!(Yii::app()->controller->id == 'article' &&
					Yii::app()->controller->action->id == 'product')) {
					$menuItems = array(
						array('label'=>Yii::t('layouts','Video Translation'), 'url'=>array('/article/video'),
							'itemOptions'=>array('class'=>'tab-label-1')),
						array('label'=>Yii::t('layouts','Text Translation'), 'url'=>array('/article/text'),
							'itemOptions'=>array('class'=>'tab-label-2')),
						array('label'=>Yii::t('layouts','My Order'), 'url'=>array('/order/index'),
							'visible'=>!Yii::app()->user->isGuest,
							'itemOptions'=>array('class'=>'tab-label-3')),
						array('label'=>Yii::t('layouts','Profile'),
							'url'=>array('/user/view','id'=>Yii::app()->user->getId()),
							'visible'=>!Yii::app()->user->isGuest,
							'itemOptions'=>array('class'=>'tab-label-4')),
						array('label'=>Yii::t('layouts','Voucher Center'), 'url'=>array('/recharge/create'),
							'visible'=>!Yii::app()->user->isGuest,
							'itemOptions'=>array('class'=>'tab-label-5')),
						array('label'=>Yii::t('layouts','Recharge'), 'url'=>array('/recharge/admin'),
							'visible'=>User::model()->isAdmin(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','Article'), 'url'=>array('/article/admin'),
							'visible'=>User::model()->isAdmin(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','Article'), 'url'=>array('/article/index'),
							'visible'=>User::model()->isTranslator(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','Order'), 'url'=>array('/order/admin'),
							'visible'=>User::model()->isAdmin(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','Msg'), 'url'=>array('/msg/admin'),
							'visible'=>User::model()->isAdmin(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','Friend'), 'url'=>array('/friend/admin'),
							'visible'=>User::model()->isAdmin(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','Msg'), 'url'=>array('/msg/new'),
							'visible'=>User::model()->isService(), 'itemOptions'=>array('class'=>'adminmenu')),
						array('label'=>Yii::t('layouts','User'), 'url'=>array('/user/admin'),
							'visible'=>User::model()->isAdmin(), 'itemOptions'=>array('class'=>'adminmenu')),
					);
					$this->widget('zii.widgets.CMenu',array(
						'items'=>$menuItems,
					));
			} ?>
		</div><!-- mainmenu -->
	</div>
</div><!-- header -->

<div class="clear"></div>

<?php if(Yii::app()->controller->id == 'site' &&
		Yii::app()->controller->action->id == 'index'): ?>
		<?php /*
		<div><?=Yii::t('layouts','MuYun Translation'); ?></div><br />
		<?php <span>be of your service</span> ?>
		<?=CHtml::link('<div id="entrance">'.Yii::t('site','Start Now').'</div>'); ?>
		*/ ?>
		<div id="slideimg">
			<table id="idSlider2" border="0" cellSpacing="0" cellPadding="0">
				<tbody>
					<tr>
						<?php for($i = 1; $i <= 2; $i++): ?>
						<td class="td_f">
							<img src="<?=Yii::app()->theme->baseUrl; ?>/img/index_<?=$i; ?>.png" />
						</td>
						<?php endfor; ?>
					</tr>
				</tbody>
			</table>
			<ul id="idNum" class="slideimgnum"></ul>
		</div>
		<br />
		<br />
<div class="clear"></div>
<?php endif; ?>

<div class="container" id="page">
	<div id="maincontent">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
	
		<?=$content; ?>
	</div>
	
	<div class="clear"></div>
	
	<div id="footerline">&nbsp;</div>
	<div id="footer">
		<dl>
			<dt><?=Yii::t('layouts','About Us'); ?></dt>
			<dd>
				<ul>
					<li><?=CHtml::link(Yii::t('layouts','Our Team'),array('/site/page', 'view'=>'about')); ?></li>
					<li><?=CHtml::link(Yii::t('layouts','Bussiness'),array('/site/page', 'view'=>'about')); ?></li>
					<li><?=CHtml::link(Yii::t('layouts','Successful Case'),array('/site/page', 'view'=>'about')); ?></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><?=Yii::t('layouts','Contact Us'); ?></dt>
			<dd>
				<ul>
					<li><?=CHtml::link(Yii::t('layouts','Feedback'),array('/msg/contact')); ?></li>
					<li><?=CHtml::link(Yii::t('layouts','Contact Way'),array('/msg/contact')); ?></li>
				</ul>
			</dd>
		</dl>
		<div class="clear"></div>
		<?=Yii::t('layouts','Copyright Reserved'); ?> &copy; <?=date('Y'); ?>
	</div><!-- footer -->
</div><!-- page -->

</body>
</html>
