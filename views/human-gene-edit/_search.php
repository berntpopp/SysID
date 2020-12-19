<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\humanGene\HumanGeneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-gene-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'human_gene_id') ?>

    <?= $form->field($model, 'entrez_id') ?>

    <?= $form->field($model, 'sysid_id') ?>

    <?= $form->field($model, 'chromosome_location') ?>

    <?= $form->field($model, 'gene_type') ?>

    <?php // echo $form->field($model, 'gene_symbol') ?>

    <?php // echo $form->field($model, 'gene_description') ?>

    <?php // echo $form->field($model, 'gene_synonyms') ?>

    <?php // echo $form->field($model, 'omim_id') ?>

    <?php // echo $form->field($model, 'ensembl_id') ?>

    <?php // echo $form->field($model, 'hprd_id') ?>

    <?php // echo $form->field($model, 'hgnc_id') ?>

    <?php // echo $form->field($model, 'hpsd') ?>

    <?php // echo $form->field($model, 'human_gene_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
