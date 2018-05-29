<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \jakharbek\users\models\Users;

/* @var $this yii\web\View */
/* @var $model jakharbek\users\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_status')->dropDownList(Users::find()->statuses()); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('jakhar-users','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
