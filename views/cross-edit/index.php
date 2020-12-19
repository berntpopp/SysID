<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\cross\CrossSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Crosses';
?>
<div class="container-fluid cross-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cross', ['create?id=0'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cross_id',
            'stock_id',
            'driver_stock_id',            
            [
                'attribute' => 'sex_type',
                'label' => 'Sex',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->sex->sex;
                },
            ],      
            'temperature_id',                       
            'cross_remark:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
