<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Users */

$this->title = Yii::t('jakhar-users','Create Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('jakhar-users','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
