<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = "Enrichment calculator";
?>

<div class="container">
    <h2>Calculate enrichment</h2>

    <div class="enrichment-calculation-form">

        <?php $form = ActiveForm::begin(); ?>    

<?= $form->field($model, 'geneList')->textarea(['rows' => 15]) ?>
<?= $form->field($model, 'background')->textarea(['rows' => 15]) ?>

        <div class="form-group">
<?= Html::submitButton('Submit', ['class' => 'btn btn-info']) ?>
        </div>
        
<?php if(count($model->FalseValues)>0): ?>
        <div id="error-log" style="color:#a94442">
            <p>Not recognized <?= $model->identifier; ?>:</p>
            <p><?= implode(', ',$model->FalseValues); ?></p>
        </div>
<?php endif; ?>

<?php ActiveForm::end(); ?>        
    </div>
</div>