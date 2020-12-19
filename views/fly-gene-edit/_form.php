<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\CGNumber;

/* @var $this yii\web\View */
/* @var $model app\models\db\FlyGene */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fly-gene-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'flybase_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'gene_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'gene_symbol')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'gene_synonyms')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'secondary_flybase_ids')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'fly_gene_remark')->textarea(['rows' => 5]) ?>
    
    <?= $form->field($model, 'cgNumbers')->hiddenInput(['value'=>implode(',', ArrayHelper::map($model->cgNumbers, 'cg_number_id', 'cg_number'))])->label('CG Number') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script>
            $('#flygene-cgnumbers').select2({tags:["<?= CGNumber::getAllCgNumbers() ?>"]});
    </script>

</div>
