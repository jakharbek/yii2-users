<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Tokens */

$this->title = $model->token_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('jakhar-users','Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tokens-view">

    <p>
        <?= Html::a(Yii::t('jakhar-users','Update'), ['update', 'id' => $model->token_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('jakhar-users','Delete'), ['delete', 'id' => $model->token_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'token_id',
            'user_id',
            'token',
            'type',
            'expire',
            'status',
        ],
    ]) ?>

</div>
