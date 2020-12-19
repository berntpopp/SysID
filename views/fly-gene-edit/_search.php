<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\flyGene\FlyGeneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fly-gene-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fly_gene_id') ?>

    <?= $form->field($model, 'flybase_id') ?>

    <?= $form->field($model, 'gene_name') ?>

    <?= $form->field($model, 'gene_symbol') ?>

    <?= $form->field($model, 'gene_synonyms') ?>

    <?php // echo $form->field($model, 'secondary_flybase_ids') ?>

    <?php // echo $form->field($model, 'fly_gene_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
