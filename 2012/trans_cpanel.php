<!DOCTYPE html>
<html>
    <head>
        <link href="<?=Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <ul class="nav nav-tabs">
            <li><a href="<?=Yii::app()->request->baseUrl; ?>/article/video">
            	<?=Yii::t("article","Working Space"); ?></a></li>
            <li class="active">
                <a href="<?=Yii::app()->request->baseUrl; ?>/article/video/cpanel">
                	<?=Yii::t("article","Control Panel"); ?></a>
            </li>
        </ul>
    </body>
</html>
