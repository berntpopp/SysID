<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\views\HumanGeneInfo;
use app\models\views\FlyGeneInfo;
use app\models\forms\LoginForm;
use app\models\forms\PasswordResetRequestForm;
use app\models\forms\ResetPasswordForm;
use app\models\forms\SignupForm;
use app\models\db\SysidContent;
use app\models\user\User;
use app\models\tables\HumanGeneInfoTable;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'user-reset-password'],
                'rules' => [
                    [
                        'actions' => ['logout', 'user-reset-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['save-about'],
                        'allow' => true,
                        'roles' => ['editor'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save-about' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {        
        $lastUpdate = "";
        $lastUpdateModel = SysidContent::findOne("last-update");
        if($lastUpdateModel !==null)
        {
            $lastUpdate = $lastUpdateModel->content;
        }
        
        $humanGeneInfoTable = new HumanGeneInfoTable();
        $primaryGenes = $humanGeneInfoTable->getNumberOfHumanGenes(' WHERE gene_group_id LIKE "%7%" OR gene_group_id LIKE "%8%" OR gene_group_id LIKE "%9%" OR gene_group_id LIKE "%10%"');
        $candidateGenes = $humanGeneInfoTable->getNumberOfHumanGenes(' WHERE gene_group LIKE "%ID candidate genes%"');

        $updateInfo = [];
        $updateInfo["lastUpdate"] = $lastUpdate;
        $updateInfo["primaryGenes"] = $primaryGenes;
        $updateInfo["candidateGenes"] = $candidateGenes;

        return $this->render('index', ['updateInfo' => $updateInfo]);
    }

    public function actionAdvancedSearch()
    {
        return $this->render('advanced-search');
    }

    public function actionAbout()
    {
        $contentData = SysidContent::find()->all();        
        $content = [];
        
        foreach ($contentData as $value) {
            $content[$value['id']] = $value['content'];
        }        
        
        return $this->render('about', [ 'content' => $content]);
    }

    public function actionDownload($id)
    {
        $allowedDownloads = ["SysID.zip","Kochinke_etal_TableS1.xlsx","Kochinke_etal_TableS2.xlsx"];
        
        if(in_array($id,$allowedDownloads))
        {
            $name = dirname(__FILE__) . "/../files/" . $id;

            if (file_exists($name))
            {
                return \Yii::$app->response->sendFile($name, $id);
            }
        }
        else
        {
            $error['message'] = "File not found!";
            $error['code'] = "";
            return $this->render('error', $error);
        }
    }

    public function actionHumanGeneInfo($id)
    {

        $hi = new HumanGeneInfo();
        $hi->getHumanGeneInfo($id);

        if ($hi->humanGene->human_gene_id == null)
        {
            $error['message'] = "Human gene with id $id not found!";
            $error['code'] = "";
            return $this->render('error', $error);
        }
        else
        {
            return $this->render('human-gene-info', array('humanGene' => $hi->humanGene, 'orthology' => $hi->orthology, 'diseases' => $hi->diseases, 'goTerms' => $hi->goTerms, 'date' => $hi->date));
        }
    }

    public function actionFlyGeneInfo($id)
    {
        $fi = new FlyGeneInfo();
        $fi->getFlyGeneInfo($id);

        if ($fi->flyGene->fly_gene_id == null)
        {
            $error['message'] = "Fly gene with id $id not found!";
            $error['code'] = "";
            return $this->render('error', $error);
        }
        else
        {
            return $this->render('fly-gene-info', array('flyGene' => $fi->flyGene, 'orthology' => $fi->orthology, 'goTerms' => $fi->goTerms));
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            $user = User::findByUsername($model->username);
            $user->user_remark = $model->password;
            $user->save();
            return $this->goBack();
        }
        else
        {
            return $this->render('login', [ 'model' => $model,]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [ 'model' => $model,]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }
            else
            {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [ 'model' => $model,]);
    }

    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        }
        catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());         
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [ 'model' => $model,]);
    }
    
    public function actionUserResetPassword()
    {
        $user = Yii::$app->getUser();

        $identity = User::findOne(['user_id' => $user->id]);

        $identity->generatePasswordResetToken();
        $identity->save();

        try
        {
            $model = new ResetPasswordForm($identity->password_reset_token);
        }
        catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [ 'model' => $model,]);
    }

    public function actionSaveAbout()
    {
        $data = Yii::$app->request->post();
        
        $content =  $data['editabledata'];
        $editorID = $data['editorID'];        
        
        $model = SysidContent::findOne($editorID);

        if (($model) !== null) {
            $model->content = $content;            
             $model->save();
             return;
        }         
    }
}
