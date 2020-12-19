<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\db\OrderNumberSource;

/* @var $this yii\web\View */
/* @var $model app\models\db\OrderNumber */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container order-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_number')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'order_number_source_id')->dropDownList(ArrayHelper::map(OrderNumberSource::find()->all(), 'order_number_source_id', 'source'))->label('Order Number Source') ?>

    <?= $form->field($model, 'order_number_svalue')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'order_number_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>  

</div>
