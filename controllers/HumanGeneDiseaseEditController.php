<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\db\HumanGeneDiseaseConnect;
use app\models\db\HHumanGeneDiseaseConnect;
use app\models\search\HHumanGeneDiseaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\db\AdditionalClassConnect;
use app\models\db\MainClassConnect;
use app\models\db\GeneReview;
use app\models\db\GeneReviewConnect;

/**
 * HumanGeneDiseaseEditController implements the CRUD actions for HumanGeneDiseaseConnect model.
 */
class HumanGeneDiseaseEditController extends Controller
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
     * Lists all HumanGeneDiseaseConnect models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HHumanGeneDiseaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single HumanGeneDiseaseConnect model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = HHumanGeneDiseaseConnect::findOne($id);

        if ($model === null)
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [ 'model' => $model,]);
    }

    /**
     * Creates a new HumanGeneDiseaseConnect model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new HumanGeneDiseaseConnect();
        $model->human_gene_id = $id;

        if ($model->load(Yii::$app->request->post()))
        {
            $model->entry_user_id = Yii::$app->user->id;
            $model->update_user_id = Yii::$app->user->id;
            $model->haploinsufficiency_yes_no = $this->getHaploinsufficiency($model->human_gene_id);

            if ($model->save())
            {
                $this->addAdditionalClasses($model, Yii::$app->request->post());
                $this->addMainClasses($model, Yii::$app->request->post());
                $this->addGeneReviews($model, Yii::$app->request->post());

                return $this->redirect(['view', 'id' => $model->human_gene_disease_id]);
            }
        }

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing HumanGeneDiseaseConnect model.
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
                $this->addAdditionalClasses($model, Yii::$app->request->post());
                $this->addMainClasses($model, Yii::$app->request->post());
                $this->addGeneReviews($model, Yii::$app->request->post());

                return $this->redirect(['view', 'id' => $model->human_gene_disease_id]);
            }
        }

        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing HumanGeneDiseaseConnect model.
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
     * Finds the HumanGeneDiseaseConnect model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HumanGeneDiseaseConnect the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HumanGeneDiseaseConnect::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function addMainClasses($model, $request)
    {
        $modelGroups = $model->mainClasses;
        $requestGroups = $request['HumanGeneDiseaseConnect']['mainClasses'];

        if ($requestGroups == '')
        {
            $requestGroups = array();
        }

        foreach ($modelGroups as $key => $value)
        {
            $found = false;
            foreach ($requestGroups as $rId)
            {
                if ($value['main_class_id'] == $rId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $model->unlink('mainClasses', $value, true);
            }
        }

        foreach ($requestGroups as $rId)
        {
            $found = false;
            foreach ($modelGroups as $key => $value)
            {
                if ($value['main_class_id'] == $rId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $newConnect = new MainClassConnect();
                $newConnect->main_class_id = $rId;
                $newConnect->human_gene_disease_id = $model->human_gene_disease_id;
                $newConnect->entry_user_id = Yii::$app->user->id;
                $newConnect->update_user_id = Yii::$app->user->id;
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }

    private function addAdditionalClasses($model, $request)
    {
        $modelGroups = $model->additionalClassConnects;
        $requestGroups = $request['HumanGeneDiseaseConnect']['additionalClasses'];

        if ($requestGroups == '')
        {
            $requestGroups = array();
        }

        foreach ($modelGroups as $key => $value)
        {
            $found = false;
            foreach ($requestGroups as $rId)
            {
                $confidence = 0;
                if ($rId > 100)
                {
                    $rId = $rId - 100;
                    $confidence = 1;
                }

                if ($value['additional_class_id'] == $rId)
                {
                    $found = true;
                    if ($value['confidence_criteria_limit_clinical_desc'] != $confidence)
                    {
                        $value['confidence_criteria_limit_clinical_desc'] = $confidence;
                        $value->update_user_id = Yii::$app->user->id;
                        $value->save();
                    }

                    break;
                }
            }

            if ($found == false)
            {
                $value->delete();
            }
        }

        foreach ($requestGroups as $rId)
        {
            $confidence = 0;
            if ($rId > 100)
            {
                $rId = $rId - 100;
                $confidence = 1;
            }

            $found = false;
            foreach ($modelGroups as $key => $value)
            {
                if ($value['additional_class_id'] == $rId)
                {
                    $found = true;
                    break;
                }
            }

            if ($found == false)
            {
                $newConnect = new AdditionalClassConnect();
                $newConnect->additional_class_id = $rId;
                $newConnect->confidence_criteria_limit_clinical_desc = $confidence;
                $newConnect->human_gene_disease_id = $model->human_gene_disease_id;
                $newConnect->entry_user_id = Yii::$app->user->id;
                $newConnect->update_user_id = Yii::$app->user->id;
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }

    private function addGeneReviews($model, $request)
    {
        $modelGroups = $model->geneReviews;
        if (!isset($request['HumanGeneDiseaseConnect']['geneReviews']) || (isset($request['HumanGeneDiseaseConnect']['geneReviews']) && $request['HumanGeneDiseaseConnect']['geneReviews']==''))
            $requestGroups = array();            
        else
            $requestGroups = explode(',', $request['HumanGeneDiseaseConnect']['geneReviews']);

        $allGeneReviews = GeneReview::getAllReviews();

        foreach ($modelGroups as $key => $value)
        {
            $found = false;
            foreach ($requestGroups as $rId)
            {
                if (!isset($allGeneReviews[$rId]))
                {
                    $found = true;
                    break;
                }
                else
                {
                    $id = $allGeneReviews[$rId];
                    if ($value['gene_review_id'] == $id)
                    {
                        $found = true;
                        break;
                    }
                }
            }

            if ($found == false)
            {
                $model->unlink('geneReviews', $value, true);
            }
        }

        foreach ($requestGroups as $rId)
        {
            $found = false;
            if (isset($allGeneReviews[$rId]))
            {
                $id = $allGeneReviews[$rId];
                foreach ($modelGroups as $key => $value)
                {
                    if ($value['gene_review_id'] == $id)
                    {
                        $found = true;
                        break;
                    }
                }
            }
            else
            {
                $newGeneReview = new GeneReview();
                $newGeneReview->gene_review = $rId;
                $newGeneReview->save();
                $id = $newGeneReview->gene_review_id;
            }

            if ($found == false)
            {
                $newConnect = new GeneReviewConnect();
                $newConnect->gene_review_id = $id;
                $newConnect->human_gene_disease_id = $model->human_gene_disease_id;
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }

    private function getHaploinsufficiency($human_gene_id)
    {
        $entrez = Yii::$app->db->createCommand("SELECT entrez_id from human_gene WHERE human_gene_id = $human_gene_id;")->queryScalar();
        $myfile = fopen(dirname(__FILE__) . '/../files/Haploinsufficiency.txt', "r") or die("Unable to open file!");
        $haploFound = false;
        while (!feof($myfile))
        {
            $hap = fgets($myfile);
            if (rtrim($hap) == $entrez)
            {
                $haploFound = true;
                break;
            }
        }
        fclose($myfile);

        return $haploFound === true ? 1 : 0;
    }

}
