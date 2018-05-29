<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Users */

$this->title = Yii::t('jakhar-users','Update User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('jakhar-users','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('jakhar-users','Update User');
?>
<div class="users-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
