<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\humanGene\HHumanGeneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Human Genes';

?>
<div class="container-fluid human-gene-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Human Gene', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sysid_id',
            'gene_symbol',
            'gene_description:ntext',
            'gene_synonyms:ntext',
            'chromosome_location',
            'gene_type',
            [
                'attribute' => 'entrez_id',                
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->entrez_id, 'http://www.ncbi.nlm.nih.gov/gene/' . $data->entrez_id, ['target' => '_blank']);},
            ],
            [
                'attribute' => 'omim_id',
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->omim_id, 'http://omim.org/entry/' . $data->omim_id, ['target' => '_blank']);},
            ],
            [
                'attribute' => 'ensembl_id',
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->ensembl_id, 'http://www.ensembl.org/Homo_sapiens/Gene/Summary?db=core;g=' . $data->ensembl_id, ['target' => '_blank']);},
            ],
            [
                'attribute' => 'hprd_id',
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->hprd_id, 'http://www.hprd.org/summary?hprd_id=' . $data->hprd_id . '&isoform_id=' . $data->hprd_id . '_1&isoform_name=Isoform_1', ['target' => '_blank']);},
            ],
            [
                'attribute' => 'hgnc_id',
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->hgnc_id, 'https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/HGNC:' . $data->hgnc_id, ['target' => '_blank']);},
            ],
            'hpsd',
            'gene_group',
            'super_go',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
