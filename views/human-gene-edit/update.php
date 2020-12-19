<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGene */

$this->title = 'Update Human Gene: ' . ' ' . $model->gene_symbol;

?>
<div class="container human-gene-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
