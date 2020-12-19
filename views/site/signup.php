<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\forms\SignupForm */

$this->title = 'Signup';

?>
    <div class="container site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'user_name') ?>
                <?= $form->field($model, 'user_designation') ?>
                <?= $form->field($model, 'user_institution_name') ?>
                <?= $form->field($model, 'user_email') ?>
                    <?= $form->field($model, 'user_password')->passwordInput() ?>
                <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
                </div>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>