<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Cross */

$this->title = 'Create Cross';
?>
<div class="container cross-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
