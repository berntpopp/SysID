<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGene */

$this->title = 'Create Human Gene';
?>
<div class="container human-gene-create">

    <h2><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form_create', [ 'model' => $model,]) ?>

</div>
