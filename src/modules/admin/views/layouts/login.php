<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\jakharbek\users\assets\UsersAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-image:url(<?=Yii::$app->params['login-page-poster']?>);">
<?php $this->beginBody() ?>


<div class="container">
    <div class="info">
        <h1><?=Yii::$app->params['login-page-header-text']?></h1></span>
    </div>
</div>

    <?=$content?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
