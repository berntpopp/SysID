<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\OrderNumberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container order-number-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'order_number_id') ?>

    <?= $form->field($model, 'order_number') ?>

    <?= $form->field($model, 'order_number_source_id') ?>

    <?= $form->field($model, 'order_number_svalue') ?>

    <?= $form->field($model, 'order_number_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
