<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\db\HumanGene;
use app\models\search\HHumanGeneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\db\GeneGroupConnect;
use app\models\update\HumanGeneUpdate;
use app\models\db\SuperGoConnect;

/**
 * HumanGeneController implements the CRUD actions for HumanGene model.
 */
class HumanGeneEditController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => [],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['update', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['editor'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all HumanGene models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HHumanGeneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single HumanGene model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [ 'model' => $this->findModel($id),]);
    }

    /**
     * Creates a new HumanGene model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HumanGene();

        if ($model->load(Yii::$app->request->post()))
        {
            $humanGeneUpdate = new HumanGeneUpdate();
            $humanGeneInfo = $humanGeneUpdate->LoadGenes([$model->entrez_id => 0]);

            if (count($humanGeneInfo) == 1)
            {
                $model->load(["HumanGene" => $humanGeneInfo[0]]);

                $this->setSysID($model);

                if ($model->save())
                {
                    $this->addGeneGroups($model, Yii::$app->request->post(), true);
                    $this->addSuperGos($model, Yii::$app->request->post());

                    return $this->redirect(['view', 'id' => $model->human_gene_id]);
                }
            } else
            {
                $model->addError('entrez_id', 'Entrez id ' . $model->entrez_id . ' not found.');
            }
        }

        return $this->render('create', [ 'model' => $model,]);
    }

    /**
     * Updates an existing HumanGene model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            if (empty($model->ensembl_id)) {
                $model->ensembl_id=null;
            }
            
            if (empty($model->omim_id)) {
                $model->omim_id=null;
            }
            
            if (empty($model->hgnc_id)) {
                $model->hgnc_id=null;
            }
            
            if (empty($model->hprd_id)) {
                $model->hprd_id=null;
            }
            
            $this->setSysID($model);

            if ($model->save())
            {
                $this->addGeneGroups($model, Yii::$app->request->post(), false);
                $this->addSuperGos($model, Yii::$app->request->post());

                return $this->redirect(['view', 'id' => $model->human_gene_id]);
            }
        }

        return $this->render('update', [ 'model' => $model,]);
    }

    /**
     * Deletes an existing HumanGene model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HumanGene model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HumanGene the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HumanGene::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function addGeneGroups($model, $request, $create)
    {
        $gg = $model->geneGroups;

        if (isset($request['HumanGene']['geneGroups']) && $request['HumanGene']['geneGroups'] != '')
        {
            $requestGeneGroups = $request['HumanGene']['geneGroups'];
        } else
        {
            $requestGeneGroups = array();
        }

        foreach ($gg as $key => $value)
        {
            $found = false;
            foreach ($requestGeneGroups as $ggKey => $ggId)
            {
                if ($value['gene_group_id'] == $ggId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $model->unlink('geneGroups', $value, true);
            }
        }

        foreach ($requestGeneGroups as $ggKey => $ggId)
        {
            $found = false;
            foreach ($gg as $key => $value)
            {
                if ($value['gene_group_id'] == $ggId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $newConnect = new GeneGroupConnect();
                $newConnect->gene_group_id = $ggId;
                $newConnect->human_gene_id = $model->human_gene_id;
                $newConnect->entry_user_id = Yii::$app->user->id;
                $newConnect->update_user_id = Yii::$app->user->id;
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }

    private function addSuperGos($model, $request)
    {
        $sg = $model->superGos;

        if (isset($request['HumanGene']['superGos']) && $request['HumanGene']['superGos'] != '')
        {
            $requestSuperGos = $request['HumanGene']['superGos'];
        } else
        {
            $requestSuperGos = array();
        }

        foreach ($sg as $key => $value)
        {
            $found = false;
            foreach ($requestSuperGos as $ggKey => $sgId)
            {
                if ($value['super_go_id'] == $sgId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $model->unlink('superGos', $value, true);
            }
        }

        foreach ($requestSuperGos as $sgKey => $sgId)
        {
            $found = false;
            foreach ($sg as $key => $value)
            {
                if ($value['super_go_id'] == $sgId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $newConnect = new SuperGoConnect();
                $newConnect->super_go_id = $sgId;
                $newConnect->human_gene_id = $model->human_gene_id;
                $newConnect->super_go_connection_type = 'M';
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }

    private function setSysID($humanGene)
    {
        if ($humanGene->sysid_id == 1)
        {
            $humanGene->sysid_id = $this->getNewSysID();
        } elseif ($humanGene->sysid_id == '')
        {
            $humanGene->sysid_id = null;
        }
    }

    private function getNewSysID()
    {
        $sysid = Yii::$app->db->createCommand("SELECT sysid_id from human_gene ORDER BY sysid_id DESC LIMIT 1;")->queryScalar();
        
        $lastId = (int)str_replace("SysID_", "", $sysid);
        $newId = $lastId + 1;
        $newSysId = "SysID_" . sprintf('%04d', $newId);        

        return $newSysId;
    }
}