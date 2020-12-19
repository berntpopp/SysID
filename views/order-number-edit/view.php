<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\OrderNumber */

$this->title = 'Order Number: ' . $model->order_number;
?>
<div class="container order-number-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->order_number_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->order_number_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', 'create', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Order numbers', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_number_id',
            'order_number',
            [
                'label' => 'Order Number Source',
                'format' => 'raw',
                'value' => $model->orderNumberSource->source,
            ],
            'order_number_svalue',
            'order_number_remark:ntext',
        ],
    ]) ?>

</div>
