<!DOCTYPE html>
<html>
    <head>
        <link href="<?=Yii::app()->theme->baseUrl; ?>/video/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <ul class="nav nav-tabs">
            <li><a href="<?=Yii::app()->request->baseUrl; ?>/index.php/article/trans_mpanel">Working Space</a></li>
            <li class="active">
                <a href="<?=Yii::app()->request->baseUrl; ?>/index.php/article/trans_cpanel">Control Panel</a>
            </li>
        </ul>
    </body>
</html>
