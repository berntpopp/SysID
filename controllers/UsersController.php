<?php

namespace app\controllers;

use Yii;
use app\models\user\User;
use app\models\user\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\forms\ResetPasswordForm;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => [],
                'rules' => [
                    [                        
                        'allow' => true,
                        'roles' => ['admin'],
                    ],                    
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [ 'model' => $this->findModel($id),]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->generateAuthKey();

            if ($model->save())
            {
                $this->assignRole($model);

                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('create', [ 'model' => $model,]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {            
            if ($model->save())
            {
                $this->assignRole($model);

                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('update', [ 'model' => $model,]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $auth = Yii::$app->authManager;
        $auth->revokeAll($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function assignRole($user)
    {
        $auth = Yii::$app->authManager;

        if ($user->user_role === '1')
        {
            $roleName = 'user';
        }
        elseif ($user->user_role === '2')
        {
            $roleName = 'editor';
        }
        elseif ($user->user_role === '3')
        {
            $roleName = 'admin';
        }

        $role = $auth->getRole($roleName);
        $auth->revokeAll($user->user_id);
        $auth->assign($role, $user->user_id);
    }
    
    public function actionResetUserPassword($id)
    {
        $identity = User::findOne(['user_id' => $id]);
        
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

        return $this->render('//site/resetPassword', [ 'model' => $model,]);
    }
}
