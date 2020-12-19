<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\orthologyManual\OrthologyManualSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-fly-orthology-manual-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'human_fly_orthology_manual_id') ?>

    <?= $form->field($model, 'human_gene_id') ?>

    <?= $form->field($model, 'fly_gene_id') ?>

    <?= $form->field($model, 'orthology_relationship_id') ?>

    <?= $form->field($model, 'orthology_source_id') ?>

    <?php // echo $form->field($model, 'to_be_investigated_2013') ?>

    <?php // echo $form->field($model, 'date_of_entry') ?>

    <?php // echo $form->field($model, 'entry_user_id') ?>

    <?php // echo $form->field($model, 'date_of_update') ?>

    <?php // echo $form->field($model, 'update_user_id') ?>

    <?php // echo $form->field($model, 'human_fly_manual_remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
