<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */

$this->title = 'Update User: ' . ' ' . $model->user_id;

?>
<div class="container user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
