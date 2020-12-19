<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\GeneGroup */

$this->title = 'Create Gene Group';
?>
<div class="container gene-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [ 'model' => $model,]) ?>

</div>
