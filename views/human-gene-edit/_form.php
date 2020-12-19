<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\GeneType;
use app\models\db\GeneGroup;
use app\models\db\SuperGo;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGene */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-gene-form">

    <?php $form = ActiveForm::begin(['options'=>['class'=>'my-inline']]); ?>

    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'sysid_id')->dropDownList(['' => 'No', $model->sysid_id == '' ? '1' : $model->sysid_id => 'Yes']) ?>

        <?= $form->field($model, 'gene_symbol')->textInput(['maxlength' => 45]) ?>
    
        <?= $form->field($model, 'gene_description')->textarea(['rows' => 2]) ?>
    
        <?= $form->field($model, 'gene_synonyms')->textarea(['rows' => 2]) ?>
    
        <?= $form->field($model, 'chromosome_location')->textInput(['max length' => 45]) ?>
    
        <?= $form->field($model, 'gene_type_id')->dropDownList(ArrayHelper::map(GeneType::find()->all(), 'gene_type_id', 'gene_type'))->label('Gene Type') ?>    
    
        <?= $form->field($model, 'entrez_id')->textInput() ?>
    
        <?= $form->field($model, 'omim_id')->textInput(['maxlength' => 45]) ?>        
      </div>
      <div class="col-md-6">      
        <?= $form->field($model, 'ensembl_id')->textInput(['maxlength' => 45]) ?>
    
        <?= $form->field($model, 'hprd_id')->textInput(['maxlength' => 45]) ?>
    
        <?= $form->field($model, 'hgnc_id')->textInput(['maxlength' => 45]) ?>
    
        <?= $form->field($model, 'hpsd')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
    
        <?= $form->field($model, 'human_gene_remark')->textarea(['rows' => 2]) ?>
    
        <?= $form->field($model, 'geneGroups')->dropDownList(ArrayHelper::map(GeneGroup::find()->all(), 'gene_group_id', 'gene_group'),['multiple'=>'multiple'])->label('Gene Group') ?>
        
        <?= $form->field($model, 'superGos')->dropDownList(ArrayHelper::map(SuperGo::find()->all(), 'super_go_id', 'super_go'),['multiple'=>'multiple'])->label('Gene Ontology-based Annotation') ?>
      </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script>
            $('#humangene-genegroups, #humangene-supergos').select2();
    </script>

</div>
