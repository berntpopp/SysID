<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\HumanFlyOrthologyManual */

$this->title = 'Create Human Fly Orthology Manual';
?>
<div class="container human-fly-orthology-manual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
