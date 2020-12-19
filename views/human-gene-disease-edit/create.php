<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGeneDiseaseConnect */

$this->title = 'Create Human Gene Disease Connection';

?>
<div class="container human-gene-disease-connect-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', ['model' => $model,  'create' => true]) ?>

</div>
