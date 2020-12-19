<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\db\FlyGene;
use app\models\update\FlyGeneUpdate;
use app\models\search\HFlyGeneSearch;
use app\models\db\CGNumberConnect;
use app\models\db\CGNumber;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FlyGeneEditController implements the CRUD actions for FlyGene model.
 */
class FlyGeneEditController extends Controller
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
     * Lists all FlyGene models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HFlyGeneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single FlyGene model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [ 'model' => $this->findModel($id),]);
    }

    /**
     * Creates a new FlyGene model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FlyGene();

        if ($model->load(Yii::$app->request->post()))
        {
            $flyGeneUpdate = new FlyGeneUpdate();
            $flyGeneInfo = $flyGeneUpdate->LoadGenes([$model->flybase_id => 0]);

            if (count($flyGeneInfo) == 1)
            {
                $model->load(["FlyGene" => $flyGeneInfo[0]]);

                if ($model->save())
                {
                    $this->addCgNumbers($model, ["FlyGene" => $flyGeneInfo[0]]);
                    return $this->redirect(['view', 'id' => $model->fly_gene_id]);
                }
            } else
            {
                $model->addError('flybase_id', 'Flybase id ' . $model->flybase_id . ' not found.');
            }
        }

        return $this->render('create', [ 'model' => $model,]);
    }

    /**
     * Updates an existing FlyGene model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            if (empty($model->flybase_id)) {
                $model->flybase_id=null;
            }
            
            if($model->save())
            {
                $this->addCgNumbers($model, Yii::$app->request->post());
                return $this->redirect(['view', 'id' => $model->fly_gene_id]);
            }
        } 
        
        return $this->render('update', [ 'model' => $model, $model]);        
    }

    /**
     * Deletes an existing FlyGene model.
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
     * Finds the FlyGene model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FlyGene the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FlyGene::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function addCgNumbers($model, $request)
    {
        $modelGroups = $model->cgNumbers;
        if (!isset($request['FlyGene']['cgNumbers']) || (isset($request['FlyGene']['cgNumbers']) && $request['FlyGene']['cgNumbers'] == ''))
            $requestGroups = array();
        else
            $requestGroups = explode(',', $request['FlyGene']['cgNumbers']);

        $allItems = CGNumber::getAllCgNumbersAndIds();

        foreach ($modelGroups as $key => $value)
        {
            $found = false;
            foreach ($requestGroups as $rId)
            {
                if (!isset($allItems[$rId]))
                {
                    $found = true;
                    break;
                } else
                {
                    $id = $allItems[$rId];
                    if ($value['cg_number_id'] == $id)
                    {
                        $found = true;
                        break;
                    }
                }
            }

            if ($found == false)
            {
                $model->unlink('cgNumbers', $value, true);
            }
        }

        foreach ($requestGroups as $rId)
        {
            $found = false;
            if (isset($allItems[$rId]))
            {
                $id = $allItems[$rId];
                foreach ($modelGroups as $key => $value)
                {
                    if ($value['cg_number_id'] == $id)
                    {
                        $found = true;
                        break;
                    }
                }
            } else
            {
                $newItem = new CGNumber();
                $newItem->cg_number = $rId;
                $newItem->save();
                $id = $newItem->cg_number_id;
            }

            if ($found == false)
            {
                $newConnect = new CGNumberConnect();
                $newConnect->cg_number_id = $id;
                $newConnect->fly_gene_id = $model->fly_gene_id;                
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }
}