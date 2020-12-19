<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\FlyGene */

$this->title = 'Fly Gene: ' . $model->flybase_id;
?>
<div class="container fly-gene-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fly_gene_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->fly_gene_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a('Create', 'create', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Fly genes', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fly_gene_id',
            [
                'attribute' => 'flybase_id',
                'format' => 'raw',
                'value' => Html::a($model->flybase_id, 'http://flybase.org/reports/' . $model->flybase_id, ['target' => '_blank']),
            ],
            'gene_name',
            'gene_symbol',
            'gene_synonyms:ntext',
            'secondary_flybase_ids:ntext',
            'fly_gene_remark:ntext',
            [
                'label' => 'CG Number',
                'format' => 'raw',
                'value' => Html::ul($model->cgNumbers, ['item' => function($item, $index) {
                        return Html::tag('li', $item->cg_number);
                    }, 'class' => 'no-list-style']),
            ],
            [
                'label' => 'Stock',
                'format' => 'raw',
                'value' => Html::ul($model->stocks, ['item' => function($item, $index) {
                        return Html::tag('li', Html::a($item->stock_id, Url::base() . '/stock-edit/view?id=' . $item->stock_id));
                    }, 'class' => 'no-list-style mb-5']) . Html::a('Add new stock', Url::base() . '/stock-edit/create?id=' . $model->fly_gene_id, ['class' => 'btn btn-xs btn-warning']),
            ],
        ],
    ])
    ?>

</div>
