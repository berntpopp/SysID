<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderNumberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Numbers';
?>
<div class="container-fluid order-number-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Order Number', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'order_number',            
            [
                'attribute' => 'source',
                'label' => 'Order number source',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->orderNumberSource->source;
                },
            ],
            'order_number_svalue',
            'order_number_remark:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
