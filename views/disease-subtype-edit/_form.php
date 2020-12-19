<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\DiseaseType;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseSubtype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disease-subtype-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'disease_type_id')->dropDownList(ArrayHelper::map(DiseaseType::find()->all(), 'disease_type_id', 'disease_type'))->label('Disease Type') ?>
    
    <?= $form->field($model, 'disease_subtype')->textInput(['maxlength' => 255]) ?>    

    <?= $form->field($model, 'omim_disease')->textInput() ?>

    <?= $form->field($model, 'sysid_yes_no')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>

    <?= $form->field($model, 'disease_subtype_remark')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
