<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\HumanFlyOrthologyManual */

$this->title = 'Manual Orthology: ' . $model->humanGene->gene_symbol . " - " . $model->flyGene->flybase_id;
?>
<div class="container human-fly-orthology-manual-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->human_fly_orthology_manual_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->human_fly_orthology_manual_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', 'create', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Orthology manual', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            [
                'label' => 'Human Gene',
                'format' => 'raw',
                'value' => Html::a($model->humanGene->gene_symbol, Url::base() . '/human-gene-edit/view?id=' . $model->human_gene_id),
            ],            
            [
                'label' => 'Fly Gene',
                'format' => 'raw',
                'value' => Html::a($model->flyGene->flybase_id, Url::base() . '/fly-gene-edit/view?id=' . $model->fly_gene_id),
            ],
            [
                'label' => 'Orthology Relationship',
                'format' => 'raw',
                'value' => $model->orthologyRelationship->orthology_relationship,
            ],
            [
                'label' => 'Orthology Source',
                'format' => 'raw',
                'value' => $model->orthologySource->orthology_source,
            ],
            'to_be_investigated_2013',            
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
            'human_fly_manual_remark:ntext',
        ],
    ]) ?>

</div>
