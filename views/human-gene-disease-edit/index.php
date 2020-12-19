<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\humanGeneDisease\HHumanGeneDiseaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diseases';

?>
<div class="container-fluid human-gene-disease-connect-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Human Gene Disease Connection', ['create?id=0'], ['class' => 'btn btn-success']) ?>
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

            //'human_gene_disease_id',            
            [
                'attribute' => 'gene_symbol',                
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->gene_symbol, Url::base() . '/human-gene-edit/view?id=' . $data->human_gene_id);},
            ],
            'inheritance_pattern',
            'inheritance_type',
            'main_class',            
            'accompanying_phenotype',
            'sysid_yes_no',
            'haploinsufficiency_yes_no',
            'limited_confidence_criterion',
            'disease_subtype',
            //'disease_type',
            //'alternative_names:ntext',
            //'additional_references:ntext',
            [
                'attribute' => 'additional_references',                
                'format' => 'raw',
                'value' => function ($data) {
                            return Html::ul(explode(",", $data->additional_references), ['item' => function($item, $index) {
                                return Html::tag('li', Html::a($item, 'http://www.ncbi.nlm.nih.gov/pubmed/' . $item, ['target' => '_blank']));
                                }, 'class'=>'no-list-style']);},
            ],
            [
                'attribute' => 'omim_disease',                
                'format' => 'raw',
                'value' => function ($data) {return Html::a($data->omim_disease, 'http://omim.org/entry/' . $data->omim_disease, ['target' => '_blank']);},
            ],
            'clinical_synopsis:ntext',
            //'gene_review',
            [
                'attribute' => 'gene_review',                
                'format' => 'raw',
                'value' => function ($data) {
                            return Html::ul(explode(", ", $data->gene_review), ['item' => function($item, $index) {
                                return Html::tag('li', Html::a($item, 'http://www.ncbi.nlm.nih.gov/pubmed/' . $item, ['target' => '_blank']));
                                }, 'class'=>'no-list-style']);},
            ],
            // 'human_gene_disease_remark:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
