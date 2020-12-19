<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\GeneGroup;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGene */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-gene-form">

    <?php $form = ActiveForm::begin(['options'=>['class'=>'my-inline']]); ?>

    <?= $form->field($model, 'sysid_id')->dropDownList(['' => 'No',  '1' => 'Yes']) ?>    

    <?= $form->field($model, 'entrez_id')->textInput() ?>    

    <?= $form->field($model, 'human_gene_remark')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'geneGroups')->dropDownList(ArrayHelper::map(GeneGroup::find()->all(), 'gene_group_id', 'gene_group'),['multiple'=>'multiple']) ?>
    
    <script>
            $('#humangene-genegroups').select2();
    </script>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
