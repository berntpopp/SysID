<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\GeneGroup */

$this->title = 'Update Gene Group: ' . ' ' . $model->gene_group;
?>
<div class="container gene-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [ 'model' => $model,]) ?>

</div>
