<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Tokens */

$this->title = Yii::t('jakhar-users','Create Tokens');
$this->params['breadcrumbs'][] = ['label' => Yii::t('jakhar-users','Tokens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tokens-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
