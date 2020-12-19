<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\FlyGene */

$this->title = 'Create Fly Gene';
?>
<div class="container fly-gene-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form_create', [
        'model' => $model,
    ]) ?>

</div>
