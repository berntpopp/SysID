<?php

namespace app\controllers;

use Yii;
use app\models\forms\EnrichmentCalculatorForm;
use app\models\DbHelper;

class EnrichmentCalculatorController extends \yii\web\Controller
{

    public function actionIndex()
    {        
        $model = new EnrichmentCalculatorForm();

        if ($model->load(Yii::$app->request->post()) && $model->Check())
        {
            $model->Calculate();

            return $this->render('result', [ 'model' => $model,]);
        }
        else
        {
            return $this->render('index', [ 'model' => $model,]);
        }

        return $this->render('index', [ 'model' => $model,]);
    }
}
