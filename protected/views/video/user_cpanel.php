<!DOCTYPE html>
<html>
    <head>
        <link href="<?=Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <ul class="nav nav-tabs">
                <li><a href="<?=Yii::app()->request->baseUrl; ?>/index.php/article/video">Conferencing</a></li>
                <li class="active">
                    <a href="<?=Yii::app()->request->baseUrl; ?>/index.php/article/video/cpanel">Control Panel</a>
                </li>
            </ul>
        </div>
    </body>
</html>
