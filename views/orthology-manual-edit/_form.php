<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\HumanGene;
use app\models\db\FlyGene;
use app\models\db\OrthologyRelationship;
use app\models\db\OrthologySource;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanFlyOrthologyManual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-fly-orthology-manual-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'human_gene_id')->dropDownList(ArrayHelper::map(HumanGene::find()->all(), 'human_gene_id', 'gene_symbol'))->label('Human Gene') ?>

    <?= $form->field($model, 'fly_gene_id')->dropDownList(ArrayHelper::map(FlyGene::find()->all(), 'fly_gene_id', 'flybase_id'))->label('Fly Gene') ?>

    <?= $form->field($model, 'orthology_relationship_id')->dropDownList(ArrayHelper::map(OrthologyRelationship::find()->all(), 'orthology_relationship_id', 'orthology_relationship'))->label('Orthology Relationship') ?>

    <?= $form->field($model, 'orthology_source_id')->dropDownList(ArrayHelper::map(OrthologySource::find()->all(), 'orthology_source_id', 'orthology_source'))->label('Orthology Source') ?>

    <?= $form->field($model, 'to_be_investigated_2013')->dropDownList([0 => "0", 1 => "1"])->label('To Be Investigated 2013') ?>

    <?= $form->field($model, 'human_fly_manual_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script>
            $('#humanflyorthologymanual-human_gene_id, #humanflyorthologymanual-fly_gene_id').select2();
    </script>

</div>
