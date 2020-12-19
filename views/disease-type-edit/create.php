<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseType */

$this->title = 'Create Disease Type';
?>
<div class="container disease-type-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
