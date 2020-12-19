<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Stock */

$this->title = 'Update Stock: ' . ' ' . $model->stock_id;
?>
<div class="container stock-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
