<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\update\HumanGeneUpdate;
use app\models\update\FlyGeneUpdate;
use app\models\update\GoUpdate;
use app\models\update\OrthologyUpdate;
use yii\web\UploadedFile;
use app\models\forms\UploadDatabaseForm;
use app\models\db\SysidContent;
use yii\filters\VerbFilter;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => [],
                'rules' => [
                    [
                        'actions' => ['index', 'update-lookup-tables', 'save-last-update'],
                        'allow' => true,
                        'roles' => ['editor'],
                    ],
                    [
                        'actions' => ['update-all', 'update-human-genes', 'update-fly-genes', 'export-database', 'download-database', 'upload-database', 'update-ontology', 'update-orthology'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save-last-update' => ['post'],
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
        ];
    }

    public function actionIndex()
    {
        $uploadDatabaseModel = new UploadDatabaseForm();
        $lastUpdateModel = SysidContent::findOne("last-update");
        $lastUpdate = "";
        if($lastUpdateModel !==null)
        {
            $lastUpdate = $lastUpdateModel->content;
        }
        return $this->render('index', [ 'lastUpdate' => $lastUpdate, 'uploadDatabaseModel' => $uploadDatabaseModel]);
    }

    public function actionUpdateHumanGenes()
    {
        set_time_limit(1000);

        $update = new HumanGeneUpdate();        
        $update->UpdateDatabase();

        set_time_limit(30);

        Yii::$app->session->setFlash('humanGeneUpdated');

        return $this->redirect('index');
    }

    public function actionUpdateFlyGenes()
    {
        set_time_limit(1000);

        $update = new FlyGeneUpdate();
        $update->UpdateDatabase();

        set_time_limit(30);

        Yii::$app->session->setFlash('flyGeneUpdated');

        return $this->redirect('index');
    }

   public function actionDownloadDatabase()
    {
        $dbhost = 'localhost';
        $dbuser = 'sysid';
        $dbpass = 'pavlisovic';
        $dbname = 'sysid_3';

        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
        mysql_select_db($dbname);

        $fileName = $dbname . "_" . date("Y-m-d-H-i-s") . '.gz';
        $backupFile = "/var/www/files/" . $fileName;
        $command = "mysqldump -u $dbuser -p$dbpass $dbname | gzip > $backupFile";
        system($command);

        mysql_close($conn);

        if (file_exists($backupFile))
        {
            return \Yii::$app->response->sendFile($backupFile, $fileName);
        }
    }
    
    public function actionExportDatabase()
    {
        $dbhost = 'localhost';
        $dbuser = 'sysid';
        $dbpass = 'pavlisovic';
        $dbname = 'sysid_3';

        $conn = mysql_connect($dbhost, $dbuser, $dbpass);

        mysql_select_db($dbname);

        $backupFile = "/var/www/files/" . $dbname . "_" . date("Y-m-d-H-i-s") . '.gz';
        $command = "mysqldump -u $dbuser -p$dbpass $dbname | gzip > $backupFile";
        system($command);

        mysql_close($conn);

        Yii::$app->session->setFlash('databaseExported');
        return $this->redirect('index');
    }

    public function actionUploadDatabase()
    {    
        $model = new UploadDatabaseForm();

        if (Yii::$app->request->isPost)
        {
            $model->databaseFile = UploadedFile::getInstance($model, 'databaseFile');
            if ($model->upload())
            {

                $dbhost = 'localhost';
                $dbuser = 'sysid';
                $dbpass = 'pavlisovic';
                $dbname = 'sysid_3';

                $conn = mysql_connect($dbhost, $dbuser, $dbpass);

                mysql_select_db($dbname);

                $dbGzFile = "/var/www/files/" . $model->databaseFile->baseName . '.' . $model->databaseFile->extension;

                $command = "gunzip < $dbGzFile | mysql -u $dbuser -p$dbpass $dbname";                
                
                system($command);        

                mysql_close($conn);
                
                //unlink($dbFile);

                Yii::$app->session->setFlash('databaseUploaded');
                return $this->redirect('index');
            }
        }

        return $this->render('index', ['model' => $model]);
    }    

    public function actionUpdateOntology()
    {
        set_time_limit(3600);

        $update = new GoUpdate();        
        $update->UpdateDatabase();

        set_time_limit(30);

        Yii::$app->session->setFlash('ontologyUpdated');

        return $this->redirect('index');
    }

    public function actionUpdateOrthology()
    {
        set_time_limit(3600);

        $update = new OrthologyUpdate();
        $update->UpdateDatabase();
        
        $updateFlyGenes = new FlyGeneUpdate();
        $updateFlyGenes->UpdateDatabase();

        set_time_limit(30);

        Yii::$app->session->setFlash('orthologyUpdated');

        return $this->redirect('index');
    }
    
    public function actionUpdateAll()
    {
         set_time_limit(3600);

        $update = new HumanGeneUpdate();        
        $update->UpdateDatabase();
        
        $update = new OrthologyUpdate();
        $update->UpdateDatabase();
        
        $updateFlyGenes = new FlyGeneUpdate();
        $updateFlyGenes->UpdateDatabase();
        
        $update = new GoUpdate();        
        $update->UpdateDatabase();

        set_time_limit(30);

        Yii::$app->session->setFlash('allUpdated');

        return $this->redirect('index');
    }
    
    public function actionUpdateLookupTables()
    {
        $sql = "DELETE FROM overview;
                INSERT overview SELECT * FROM t_overview;
                DELETE FROM disease;
                INSERT disease SELECT * FROM t_disease;";
        
        Yii::$app->db->createCommand($sql)->execute();
        
        Yii::$app->session->setFlash('tablesUpdated');

        return $this->redirect('index');        
    }
    
    public function actionSaveLastUpdate()
    {
        $data = Yii::$app->request->post();
        $content =  $data['lastUpdate'];
        $id = "last-update";

        $model = SysidContent::findOne($id);

        if (($model) === null) {
            $model = new SysidContent();
            $model->id = $id;
            $model->content = $content;
            $model->save();
            return;
        }
        else {
            $model->content = $content;
            $model->save();
            return;
        }
    }
}
