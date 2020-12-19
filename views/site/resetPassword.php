<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\forms\ResetPasswordForm */

$this->title = 'Reset password';

?>

    <div class="container site-reset-password">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please choose your new password:</p>

        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                    <?= $form->field($model, 'user_password')->passwordInput(['placeholder' => 'Password']) ?>
                    <?= $form->field($model, 'confirm_user_password')->passwordInput(['placeholder' => 'Password']) ?>
                <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
                </div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>