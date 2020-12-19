<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\orthologyManual\OrthologyManualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Human Fly Orthology Manuals';
?>
<div class="container-fluid human-fly-orthology-manual-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Human Fly Orthology Manual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'human_symbol',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->humanGene->gene_symbol, 'human-gene-edit/view?id=' . $data->human_gene_id);
                },
            ],
            [
                'attribute' => 'flybase_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->flyGene->flybase_id, 'fly-gene-edit/view?id=' . $data->fly_gene_id);
                },
            ],
            [
                'attribute' => 'orthology_relationship',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->orthologyRelationship->orthology_relationship;
                },
            ],
            [
                'attribute' => 'orthology_source',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->orthologySource->orthology_source;
                },
            ],            
            'to_be_investigated_2013',
            'human_fly_manual_remark:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
