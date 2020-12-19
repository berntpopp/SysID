<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\GeneGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gene-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gene_group')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'gene_group_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
