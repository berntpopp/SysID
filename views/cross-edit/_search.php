<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\cross\CrossSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cross-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cross_id') ?>

    <?= $form->field($model, 'stock_id') ?>

    <?= $form->field($model, 'driver_stock_id') ?>

    <?= $form->field($model, 'sex_id') ?>

    <?= $form->field($model, 'temperature_id') ?>

    <?php // echo $form->field($model, 'cross_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
