<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\diseaseSubtype\DiseaseSubtypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disease-subtype-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'disease_subtype_id') ?>

    <?= $form->field($model, 'disease_subtype') ?>

    <?= $form->field($model, 'disease_type_id') ?>

    <?= $form->field($model, 'omim_disease') ?>

    <?= $form->field($model, 'sysid_yes_no') ?>

    <?php // echo $form->field($model, 'disease_subtype_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
