<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGene */

$this->title = 'Human Gene: ' . $model->gene_symbol;

?>
<div class="container human-gene-view">
    
    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->human_gene_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->human_gene_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', 'create', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Human genes', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'human_gene_id',
            'sysid_id',
            'gene_symbol',
            'gene_description:ntext',
            'gene_synonyms:ntext',            
            'chromosome_location',
            'geneType.gene_type',
            [
                'attribute' => 'entrez_id',                
                'format' => 'raw',                
                'value' => Html::a($model->entrez_id, 'http://www.ncbi.nlm.nih.gov/gene/' . $model->entrez_id, ['target' => '_blank']),
            ],
            [
                'attribute' => 'omim_id',                
                'format' => 'raw',
                'value' => Html::a($model->omim_id, 'http://omim.org/entry/' . $model->omim_id, ['target' => '_blank']),
            ],
            [
                'attribute' => 'ensembl_id',                
                'format' => 'raw',
                'value' => Html::a($model->ensembl_id, 'http://www.ensembl.org/Homo_sapiens/Gene/Summary?db=core;g=' . $model->ensembl_id, ['target' => '_blank']),
            ],
            [
                'attribute' => 'hprd_id',                
                'format' => 'raw',
                'value' => Html::a($model->hprd_id, 'http://www.hprd.org/summary?hprd_id=' . $model->hprd_id . '&isoform_id=' . $model->hprd_id . '_1&isoform_name=Isoform_1', ['target' => '_blank']),
            ],
            [
                'attribute' => 'hgnc_id',                
                'format' => 'raw',
                'value' => Html::a($model->hgnc_id, 'https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/HGNC:' . $model->hgnc_id, ['target' => '_blank']),
            ],
            'hpsd',
            'human_gene_remark:ntext',
            [
                'label' => 'Gene group',                
                'format'=> 'raw',
                'value' => Html::ul($model->geneGroups, ['item' => function($item, $index) {
                            return Html::tag('li', $item->gene_group);
                        }, 'class'=>'no-list-style']),
            ],
            [
                'label' => 'Gene ontology-based annotation',                
                'format'=> 'raw',
                'value' => Html::ul($model->superGos, ['item' => function($item, $index) {
                            return Html::tag('li', $item->super_go);
                        }, 'class'=>'no-list-style']),
            ],
                                [
                'label' => 'Disease',                
                'format'=> 'raw',
                'value' => Html::ul($model->humanGeneDiseaseConnects, ['item' => function($item, $index) {
                            return Html::tag('li', Html::a($item->diseaseSubtype->disease_subtype, Url::base() . '/human-gene-disease-edit/view?id=' . $item->human_gene_disease_id));
                        }, 'class'=>'no-list-style mb-5']) . Html::a('Add new disease',Url::base() . '/human-gene-disease-edit/create?id=' . $model->human_gene_id, ['class'=>'btn btn-xs btn-warning']),
            ],
        ],
    ]) ?>

</div>
