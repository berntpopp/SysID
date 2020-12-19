<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\DiseaseType */

$this->title = $model->disease_type;
?>
<div class="container disease-type-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->disease_type_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->disease_type_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a('Create', 'create', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Disease types', './', ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'disease_type_id',
            'disease_type',
            [
                'attribute' => 'diseaseSubtypes',
                'format' => 'raw',
                'value' => Html::ul($model->diseaseSubtypes, ['item' => function($item, $index) {
                        return Html::tag('li', Html::a($item->disease_subtype, Url::base() . '/disease-subtype-edit/view?id=' . $item->disease_subtype_id));
                    }, 'class' => 'no-list-style mb-5']) . Html::a('Add new disease', Url::base() . '/disease-subtype-edit/create?id=' . $model->disease_type_id, ['class' => 'btn btn-xs btn-warning']),
            ],
            'disease_type_remark:ntext',
        ],
    ])
    ?>

</div>
