<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \jakharbek\users\models\Users;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('jakhar-users','Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('jakhar-users','Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'login',
            'email:email',
            'phone',
            [
                'attribute'=>'user_status',
                'format'=>'text',
                'content'=>function($data){
                    return Users::find()->statuses()[$data->user_status];
                },
                'filter' => Users::find()->statuses()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
