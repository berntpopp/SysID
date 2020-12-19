<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Stock */

$this->title = 'Stock: ' . $model->stock_id;
?>
<div class="container stock-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->stock_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->stock_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create?id=0'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Stocks', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'stock_id',
            'stock_remark:ntext',
            [
                'label' => 'Stock Type',
                'format' => 'raw',
                'value' => $model->stockType->stock_type,
            ],
            [
                'label' => 'Stock Type Remark',
                'format' => 'raw',
                'value' => $model->stockType->stock_type_remark,
            ],            
            [
                'label' => 'Order Number',
                'format' => 'raw',
                'value' => $model->orderNumber->order_number,
            ],
            [
                'label' => 'Order Number S Value',
                'format' => 'raw',
                'value' => $model->orderNumber->order_number_svalue,
            ],
            [
                'label' => 'Order Number Remark',
                'format' => 'raw',
                'value' => $model->orderNumber->order_number_remark,
            ],
            [
                'label' => 'Order Number Source',
                'format' => 'raw',
                'value' => $model->orderNumber->orderNumberSource->source,
            ],
            [
                'label' => 'Order Number Source Remark',
                'format' => 'raw',
                'value' => $model->orderNumber->orderNumberSource->order_number_source_remark,
            ],
            [
                'label' => 'Flybase Id',
                'format' => 'raw',
                'value' => Html::a($model->flyGene->flybase_id, Url::base() . '/fly-gene-edit/view?id=' . $model->flyGene->fly_gene_id),
            ],
            [
                'label' => 'Driver Stock',
                'format' => 'raw',
                'value' => Html::ul($model->crosses, ['item' => function($item, $index) {
                        return Html::tag('li', Html::a($item->driver_stock_id, Url::base() . '/stock-edit/view?id=' . $item->driver_stock_id));
                    }, 'class' => 'no-list-style mb-5']) . Html::a('Add new cross', Url::base() . '/cross-edit/create?id=' . $model->stock_id, ['class' => 'btn btn-xs btn-warning']),
            ],
        ],
    ]) ?>

</div>
