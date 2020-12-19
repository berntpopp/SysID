<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\OrderNumber */

$this->title = 'Create Order Number';
?>
<div class="container order-number-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
