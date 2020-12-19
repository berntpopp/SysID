<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Cross */

$this->title = 'Cross: ' . $model->cross_id;
?>
<div class="container cross-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cross_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cross_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create?id=0'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Crosses', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cross_id',
            'stock_id',
            'driver_stock_id',
            [
                'attribute' => 'sex',
                'format' => 'raw',
                'value' => $model->sex->sex,
            ],
            'temperature_id',
            'cross_remark:ntext',
        ],
    ]) ?>

</div>
