<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'user_designation')->textInput(['maxlength' => 45]) ?>
    
    <?= $form->field($model, 'user_institution_name')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'user_email')->textInput(['maxlength' => 45]) ?>
    
    <?= $form->field($model, 'user_remark')->textInput() ?>
    
    <?= $form->field($model, 'user_role')->dropDownList(['1' => 'user', '2' => 'editor', '3' => 'admin']) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'active', '0' => 'deleted']) ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php if(!$model->isNewRecord) :?>
    <div class="form-group">
        <p><?= Html::a('Change password', ['reset-user-password', 'id' => $model->user_id], ['class' => 'btn btn-warning']) ?></p>        
    </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
