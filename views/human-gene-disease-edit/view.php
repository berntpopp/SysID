<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanGeneDiseaseConnect */

$this->title = $model->disease_subtype;

?>
<div class="container human-gene-disease-connect-view">    

    <h2><?= Html::encode($this->title) ?></h2>
    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->human_gene_disease_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->human_gene_disease_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create?id=0'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Gene disease connections', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'human_gene_disease_id',            
            [
                'attribute' => 'gene_symbol',                
                'format' => 'raw',
                'value' => Html::a($model->gene_symbol, Url::base() . '/human-gene-edit/view?id=' . $model->human_gene_id),
            ],
            'inheritance_pattern',
            'inheritance_type',
            'main_class',            
            'accompanying_phenotype',
            'sysid_yes_no',
            'haploinsufficiency_yes_no',
            'limited_confidence_criterion',            
            [
                'attribute' => 'disease_subtype',
                'format'=> 'raw',
                'value' => Html::a($model->disease_subtype, Url::base() . '/disease-subtype-edit/view?id=' . $model->disease_subtype_id)
            ],
            [
                'attribute' => 'disease-type',
                'format'=> 'raw',
                'value' => Html::a($model->disease_type, Url::base() . '/disease-type-edit/view?id=' . $model->disease_type_id)
            ],
            'alternative_names:ntext',            
            [
                'attribute' => 'additional_references',                
                'format' => 'raw',
                'value' => Html::ul(explode(",", $model->additional_references), ['item' => function($item, $index) {
                                return Html::tag('li', Html::a($item, 'http://www.ncbi.nlm.nih.gov/pubmed/' . $item, ['target' => '_blank']));
                                }, 'class'=>'no-list-style']),
            ],
            [
                'attribute' => 'omim_disease',                
                'format' => 'raw',
                'value' => Html::a($model->omim_disease, 'http://omim.org/entry/' . $model->omim_disease, ['target' => '_blank']),
            ],
            'clinical_synopsis:ntext',            
            [
                'attribute' => 'gene_review',                
                'format' => 'raw',
                'value' => Html::ul(explode(", ", $model->gene_review), ['item' => function($item, $index) {
                                return Html::tag('li', Html::a($item, 'http://www.ncbi.nlm.nih.gov/pubmed/' . $item, ['target' => '_blank']));
                                }, 'class'=>'no-list-style']),
            ],
            'human_gene_disease_remark:ntext',
	    [
                'label' => 'Entered by',
                'format' => 'raw',
                'value' => $model->entryUser->user_name,
            ], 
            'date_of_entry',            
            [
                'label' => 'Updated by',
                'format' => 'raw',
                'value' => $model->update_user_id > 0 ? $model->updateUser->user_name : '',
            ], 
            'date_of_update',
        ],
    ]) ?>

</div>
