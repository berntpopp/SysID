<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\diseaseSubtype\DiseaseSubtypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin';
?>
<div class="container">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php if (Yii::$app->session->hasFlash('humanGeneUpdated')): ?>

        <div class="alert alert-success">
            Human gene info successfully updated.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('flyGeneUpdated')): ?>

        <div class="alert alert-success">
            Fly gene info successfully updated.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('orthologyUpdated')): ?>

        <div class="alert alert-success">
            Ensembl orthology successfully updated.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('ontologyUpdated')): ?>

        <div class="alert alert-success">
            Ontology successfully updated.
        </div>    

    <?php elseif (Yii::$app->session->hasFlash('databaseExported')): ?>

        <div class="alert alert-success">
            Database successfully exported.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('databaseUploaded')): ?>

        <div class="alert alert-success">
            Database successfully uploaded.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('allUpdated')): ?>

        <div class="alert alert-success">
            Database successfully updated.
        </div>

    <?php elseif (Yii::$app->session->hasFlash('tablesUpdated')): ?>

        <div class="alert alert-success">
            Lookup tables successfully updated.
        </div>



    <?php else: ?>
        <p><?= Html::a('Change password', ['/user-reset-password']) ?></p>
        <p><?=
            Html::a('Update overview table', ['update-lookup-tables'], [
                'data' => [
                    'confirm' => 'Are you sure you want to update overview table?',
                    'method' => 'post',
                ],])
            ?></p>
        <p>
            <span>Last update:</span>
            <input type="text" id="last-update" style="height:26px;margin:0 3px;text-align:right;padding-right: 5px;width:110px;" value="<?=$lastUpdate?>">
            <button id="save-last-update" type="button" onclick="saveLastUpdate()">Save</button>
            <span id="save-last-update-result" style="margin: 0 3px; display: none">Saved</span>
            <script>
            function saveLastUpdate() {
                var lastUpdate = $("#last-update").val();
                console.log(lastUpdate);
                $.post("admin/save-last-update", {lastUpdate: lastUpdate}, function(){
                    $("#save-last-update-result").fadeIn(10);
                    $("#save-last-update-result").fadeOut(2000);
                });
            }
            </script>
        </p>
        <?php if (Yii::$app->user->can('manage')) : ?>    
	<p><?=
            Html::a('Update all', ['update-all'], [
                'data' => [
                    'confirm' => 'Are you sure you want to update database?',
                    'method' => 'post',
                ],])
            ?></p>
        <p><?=
            Html::a('Update human genes', ['update-human-genes'], [
                'data' => [
                    'confirm' => 'Are you sure you want to update database human gene info?',
                    'method' => 'post',
                ],])
            ?></p>
        <p><?=
            Html::a('Update fly genes', ['update-fly-genes'], [
                'data' => [
                    'confirm' => 'Are you sure you want to update database fly gene info?',
                    'method' => 'post',
                ],])
            ?></p>
        <p><?=
            Html::a('Update ensembl orthology', ['update-orthology'], [
                'data' => [
                    'confirm' => 'Are you sure you want to update orthology?',
                    'method' => 'post',
                ],])
            ?></p>
        <p><?=
            Html::a('Update human ontology', ['update-ontology'], [
                'data' => [
                    'confirm' => 'Are you sure you want to update ontology?',
                    'method' => 'post',
                ],])
            ?></p>        
        <p><?= Html::a('Export database', ['export-database']) ?></p>
        <p><?= Html::a('Download database', ['download-database']) ?></p>

        <?php $form = ActiveForm::begin(['method' => 'post', 'action' => ['admin/upload-database'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
        <p>Upload Database</p>
        <?= $form->field($uploadDatabaseModel, 'databaseFile')->fileInput()->label(false) ?>

        <input type="submit" value="Upload" class="btn-link">

        <?php ActiveForm::end() ?>
        
        <?php endif; ?>
    <?php endif; ?>

</div>
