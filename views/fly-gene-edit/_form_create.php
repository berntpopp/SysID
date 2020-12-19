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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>    

</div>
