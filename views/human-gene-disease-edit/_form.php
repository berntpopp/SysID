<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\HumanGene;
use app\models\db\InheritancePattern;
use app\models\db\InheritanceType;
use app\models\db\MainClass;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGeneDiseaseConnect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="human-gene-disease-connect-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'human_gene_id')->dropDownList(HumanGene::getIdSymbolArray())->label('Human Gene') ?>

          <?php //$form->field($model, 'disease_subtype_id')->dropDownList(ArrayHelper::map(\app\models\db\DiseaseSubtype::find()->all(), 'disease_subtype_id', 'disease_subtype'))->label('Disease Subtype')  ?>
    
          <?= $form->field($model, 'disease_subtype_id')->dropDownList(\app\models\db\HumanGeneDiseaseConnect::getDiseasesHierarchy())->label('Disease Subtype <a href="../disease-subtype-edit/create?id=0" style="font-weight:normal;margin-left:20px">New disease subtype</a> <a href="../disease-type-edit/create" style="font-weight:normal;margin-left:20px">New disease type</a>') ?>    

          <?= $form->field($model, 'inheritance_pattern_id')->dropDownList(ArrayHelper::map(InheritancePattern::find()->all(), 'inheritance_pattern_id', 'inheritance_pattern'))->label('Inheritance Pattern') ?>

          <?= $form->field($model, 'inheritance_type_id')->dropDownList(ArrayHelper::map(InheritanceType::find()->all(), 'inheritance_type_id', 'inheritance_type'))->label('Inheritance Type') ?>

          <?= $form->field($model, 'mainClasses')->dropDownList(ArrayHelper::map(MainClass::find()->all(), 'main_class_id', 'main_class_type'), ['multiple' => 'multiple'])->label('Main Class') ?>

          <?= $form->field($model, 'additionalClasses')->dropDownList($model->getAllAdditionalClasses(), ['multiple' => 'multiple'])->label('Accompanying Phenotype') ?>

        <?php if($create === false): ?>
            <?= $form->field($model, 'haploinsufficiency_yes_no')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
        <?php endif; ?>

        <?= $form->field($model, 'confidence_criteria_limit_no_patient')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
        
      </div>
      <div class="col-md-6">

        <?= $form->field($model, 'alternative_names')->textarea(['rows' => 3]) ?>
    
        <?= $form->field($model, 'additional_references')->hiddenInput(['value'=>$model->additional_references])  ?>    
    
        <?= $form->field($model, 'clinical_synopsis')->textarea(['rows' => 3]) ?>
        
        <?= $form->field($model, 'geneReviews')->hiddenInput(['value'=>implode(',', ArrayHelper::map($model->geneReviews, 'gene_review_id', 'gene_review'))]) ?>
    
        <?= $form->field($model, 'human_gene_disease_remark')->textarea(['rows' => 3]) ?>
        
      </div>
    </div>
        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script>        
        $("#humangenediseaseconnect-additional_references, #humangenediseaseconnect-genereviews").select2({tags: []});
        $('#humangenediseaseconnect-human_gene_id, #humangenediseaseconnect-disease_subtype_id, #humangenediseaseconnect-mainclasses, #humangenediseaseconnect-additionalclasses').select2();        
    </script>
</div>
