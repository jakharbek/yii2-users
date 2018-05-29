<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TokensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('jakhar-users','Tokens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tokens-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('jakhar-users','Create Tokens'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'token_id',
            'user_id',
            'token',
            'type',
            'expire',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
