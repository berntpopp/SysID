<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\FlyGene */

$this->title = 'Update Fly Gene: ' . ' ' . $model->flybase_id;
?>
<div class="container fly-gene-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
