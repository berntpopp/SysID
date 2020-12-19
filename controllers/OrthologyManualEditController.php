<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\db\HumanFlyOrthologyManual;
use app\models\search\OrthologyManualSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrthologyManualEditController implements the CRUD actions for HumanFlyOrthologyManual model.
 */
class OrthologyManualEditController extends Controller
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
     * Lists all HumanFlyOrthologyManual models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrthologyManualSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single HumanFlyOrthologyManual model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [ 'model' => $this->findModel($id),]);
    }

    /**
     * Creates a new HumanFlyOrthologyManual model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HumanFlyOrthologyManual();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->entry_user_id = Yii::$app->user->id;
            $model->update_user_id = Yii::$app->user->id;

            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->human_fly_orthology_manual_id]);
            }
        }

        return $this->render('create', [ 'model' => $model,]);
    }

    /**
     * Updates an existing HumanFlyOrthologyManual model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            $model->update_user_id = Yii::$app->user->id;

            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->human_fly_orthology_manual_id]);
            }
        }

        return $this->render('update', [ 'model' => $model,]);
    }

    /**
     * Deletes an existing HumanFlyOrthologyManual model.
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
     * Finds the HumanFlyOrthologyManual model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HumanFlyOrthologyManual the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HumanFlyOrthologyManual::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
