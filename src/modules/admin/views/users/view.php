<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use jakharbek\users\models\Users;

/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Users */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => Yii::t('jakhar-users','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">
    <p>
        <?= Html::a(Yii::t('jakhar-users','Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('jakhar-users','Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('jakhar-users','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'login',
            'email:email',
            'phone',
            [
                'label' => $model->attributeLabels()['user_status'],
                'value' => Users::find()->statuses()[$model->user_status],
                'contentOptions' => ['class' => 'bg-red'],     // настройка HTML атрибутов для тега, соответсвующего value
                'captionOptions' => ['tooltip' => 'Tooltip'],  // настройка HTML атрибутов для тега, соответсвующего label
            ],
        ],
    ]) ?>

</div>
