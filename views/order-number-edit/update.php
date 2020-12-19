<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\OrderNumber */

$this->title = 'Update Order Number: ' . ' ' . $model->order_number;
?>
<div class="container order-number-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
