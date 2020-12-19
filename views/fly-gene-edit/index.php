<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\flyGene\HFlyGeneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fly Genes';
?>
<div class="container-fluid fly-gene-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fly Gene', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'flybase_id',                
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->flybase_id, 'http://flybase.org/reports/' . $data->flybase_id, ['target' => '_blank']);},
            ],
            'gene_name',
            'gene_symbol',
            'gene_synonyms:ntext',
            'secondary_flybase_ids:ntext',
            [
                'attribute' => 'cg_number',                
                'format' => 'raw',
                'value' => function ($data) {
                            return Html::ul(explode(",", $data->cg_number), ['item' => function($item, $index) {
                                return Html::tag('li', $item);
                                }, 'class'=>'no-list-style']);},
            ],            
            [
                'attribute' => 'stock_id',                
                'format' => 'raw',
                'value' => function ($data) {
                            return Html::ul(explode(",", $data->stock_id), ['item' => function($item, $index) {
                                return Html::tag('li', Html::a($item, 'stock-edit/view?id=' . $item));
                                }, 'class'=>'no-list-style']);},
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
