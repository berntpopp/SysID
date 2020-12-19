<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\stock\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stocks';
?>
<div class="container-fluid stock-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stock', ['create?id=0'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'stock_id',
            'stock_remark:ntext', 
            'stock_type',
            'stock_type_remark',
            'order_number',
            'order_number_svalue',
            'order_number_remark',
            'order_number_source',
            'order_number_source_remark',            
            [
                'attribute' => 'flybase_id',                
                'format' => 'raw',
                'value' => function ($data) {  return Html::a($data->flybase_id, 'fly-gene-edit/view?id=' . $data->fly_gene_id);},
                               
            ],
            [
                'attribute' => 'driver_stock_id',                
                'format' => 'raw',
                'value' => function ($data) {
                            return Html::ul(explode(",", $data->driver_stock_id), ['item' => function($item, $index) {
                                return Html::tag('li', Html::a($item, 'stock-edit/view?id=' . $item));
                                }, 'class'=>'no-list-style']);},
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
