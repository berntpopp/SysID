<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGeneDiseaseConnect */

$this->title = 'Update Human Gene Disease Connection: ' . ' ' . $model->human_gene_disease_id;
?>
<div class="container human-gene-disease-connect-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [ 'model' => $model, 'create' => false]) ?>

</div>
