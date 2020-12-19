<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Stock */

$this->title = 'Create Stock';
?>
<div class="container stock-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
