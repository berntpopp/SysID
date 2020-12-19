<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\diseaseSubtype\DiseaseSubtypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disease Subtypes';
?>
<div class="container-fluid disease-subtype-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Disease Subtype', ['create?id=0'], ['class' => 'btn btn-success']) ?>
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
            'disease_subtype',
            [
                'attribute' => 'diseaseTypeName',
                'label' => 'Disease Type',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->diseaseType->disease_type, Url::base() . '/disease-type-edit/view?id=' . $data->diseaseType->disease_type_id);
                },
            ],
            'omim_disease',
            'sysid_yes_no',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
