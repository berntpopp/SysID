<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseType */

$this->title = 'Update Disease Type: ' . ' ' . $model->disease_type;
?>
<div class="container disease-type-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
