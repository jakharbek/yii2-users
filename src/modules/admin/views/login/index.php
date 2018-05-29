<?php
    use jakharbek\users\models\Users;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="form">
    <div class="thumbnail">
        <img src="<?=Yii::$app->params['login-page-logo']?>"/>
    </div>

                <?php $form = ActiveForm::begin(['options' => ['class' => 'login-form']]); ?>

                <?=$form->field($model, 'login')->textInput(['maxlength' => true,'placeholder' => 'User'])->label(false)?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'placeholder' => 'Password'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('jakhar-users','Login'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
</div>
