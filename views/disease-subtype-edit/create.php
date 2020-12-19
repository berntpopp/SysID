<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseSubtype */

$this->title = 'Create Disease Subtype';
?>
<div class="container disease-subtype-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [ 'model' => $model,]) ?>

</div>
