<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseSubtype */

$this->title = 'Update Disease Subtype: ' . ' ' . $model->disease_subtype;

?>
<div class="container disease-subtype-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
