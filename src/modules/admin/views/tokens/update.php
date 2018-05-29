<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Tokens */

$this->title = Yii::t('jakhar-users','Update Tokens');
$this->params['breadcrumbs'][] = ['label' => Yii::t('jakhar-users','Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->token_id, 'url' => ['view', 'id' => $model->token_id]];
$this->params['breadcrumbs'][] = Yii::t('jakhar-users','Update');
?>
<div class="tokens-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
