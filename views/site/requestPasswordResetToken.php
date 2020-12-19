<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\forms\PasswordResetRequestForm */

$this->title = 'Request password reset';

?>

    <div class="container site-request-password-reset">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out your email. A link to reset password will be sent there.</p>

        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <?= $form->field($model, 'user_email')->textInput(['placeholder' => 'Email']) ?>
                <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-info']) ?>
                </div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
