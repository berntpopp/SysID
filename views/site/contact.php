<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\forms\ContactForm */

$this->title = 'Contact us';

?>
<div class="container site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Thank you for contacting us.
    </div>

    <?php else: ?>

    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Name']) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>
                <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject']) ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>                
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-info bigger-padding-btn', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
