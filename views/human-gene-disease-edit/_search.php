<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\humanGeneDisease\HumanGeneDiseaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-gene-disease-connect-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'human_gene_disease_id') ?>

    <?= $form->field($model, 'human_gene_id') ?>

    <?= $form->field($model, 'disease_subtype_id') ?>

    <?= $form->field($model, 'inheritance_pattern_id') ?>

    <?= $form->field($model, 'inheritance_type_id') ?>

    <?php // echo $form->field($model, 'haploinsufficiency_yes_no') ?>

    <?php // echo $form->field($model, 'confidence_criteria_limit_no_patient') ?>

    <?php // echo $form->field($model, 'alternative_names') ?>

    <?php // echo $form->field($model, 'additional_references') ?>

    <?php // echo $form->field($model, 'clinical_synopsis') ?>

    <?php // echo $form->field($model, 'date_of_entry') ?>

    <?php // echo $form->field($model, 'entry_user_id') ?>

    <?php // echo $form->field($model, 'date_of_update') ?>

    <?php // echo $form->field($model, 'update_user_id') ?>

    <?php // echo $form->field($model, 'human_gene_disease_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
