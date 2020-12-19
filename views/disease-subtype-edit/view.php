<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseSubtype */

$this->title = $model->disease_subtype;

?>
<div class="container disease-subtype-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->disease_subtype_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->disease_subtype_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create?id=0'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Disease subtypes', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'disease_subtype_id',
            'disease_subtype',
            [
                'attribute' => 'diseaseType',
                'format'=> 'raw',
                'value' => Html::a($model->diseaseType->disease_type, Url::base() . '/disease-type-edit/view?id=' . $model->disease_type_id)
            ],
            'omim_disease',
            'sysid_yes_no',
            'disease_subtype_remark:ntext',
        ],
    ]) ?>

</div>
