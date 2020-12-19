<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\Sex;
use app\models\db\Stock;
use app\models\db\Temperature;

/* @var $this yii\web\View */
/* @var $model app\models\db\Cross */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cross-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'stock_id')->dropDownList(ArrayHelper::map(Stock::find()->all(), 'stock_id', 'stock_id'))->label('Stock') ?>
    
    <?= $form->field($model, 'driver_stock_id')->dropDownList(ArrayHelper::map(Stock::find()->all(), 'stock_id', 'stock_id'))->label('Driver Stock') ?>

    <?= $form->field($model, 'sex_id')->dropDownList(ArrayHelper::map(Sex::find()->all(), 'sex_id', 'sex'))->label('Sex') ?>

    <?= $form->field($model, 'temperature_id')->dropDownList(ArrayHelper::map(Temperature::find()->all(), 'temperature_id', 'temperature'))->label('Temperature') ?>

    <?= $form->field($model, 'cross_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script>
            $('#cross-stock_id, #cross-driver_stock_id').select2();
    </script>

</div>
