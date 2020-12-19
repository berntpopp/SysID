<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanFlyOrthologyManual */

$this->title = 'Update Human Fly Orthology Manual: ' . ' ' . $model->human_fly_orthology_manual_id;
?>
<div class="container human-fly-orthology-manual-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
