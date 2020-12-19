<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disease-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'disease_type')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'disease_type_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
