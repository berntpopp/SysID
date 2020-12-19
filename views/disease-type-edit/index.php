<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\diseaseType\DiseaseTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disease Types';
?>
<div class="container-fluid disease-type-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Disease Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'disease_type',
            'disease_type_remark:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
