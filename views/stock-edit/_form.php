<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\StockType;
use app\models\db\OrderNumber;
use app\models\db\FlyGene;

/* @var $this yii\web\View */
/* @var $model app\models\db\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'stock_id')->textInput(); ?>
    
    <?= $form->field($model, 'stock_type_id')->dropDownList(ArrayHelper::map(StockType::find()->all(), 'stock_type_id', 'stock_type'))->label('Stock Type') ?>

    <?= $form->field($model, 'order_number_id')->dropDownList(ArrayHelper::map(OrderNumber::find()->all(), 'order_number_id', 'order_number'))->label('Order Number') ?>

    <?= $form->field($model, 'fly_gene_id')->dropDownList(ArrayHelper::map(FlyGene::find()->all(), 'fly_gene_id', 'flybase_id'))->label('Fly Gene') ?>

    <?= $form->field($model, 'stock_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script>
            $('#stock-order_number_id, #stock-fly_gene_id').select2();
    </script>

</div>
