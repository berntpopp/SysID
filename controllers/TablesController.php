<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Where;
use app\models\tables\DiseaseInfoTable;
use app\models\tables\FlyGeneInfoTable;
use app\models\tables\HumanGeneInfoTable;
use app\models\tables\OrthologyTable;
use app\models\tables\OverviewTable;
use app\models\tables\NeuronalScreenTable;
use app\models\tables\WingScreenTable;
use app\models\tables\TranscriptionFactorTable;
use app\models\tables\MotifTable;

class TablesController extends Controller
{
    private $tables = [
        'overview',
        'human-gene-info',
        'fly-gene-info',
        'disease-info',
        'orthology',
        'neuronal-screen',
        'wing-screen',
        'transcription-factor',
        'motif'
    ];

    public function actionIndex($id)
    {
        if (in_array($id, $this->tables))
        {
            return $this->render('table', array('tableName' => $id));
        } else
        {
            return $this->render('/site/error', array('name' => 'Not Found (#404)', 'message' => 'Page not found.'));
        }
    }

    public function actionGetData($id)
    {
        $tableExport = false;

        if (isset($_GET['exportt']))
        {
            if ($_GET['exportt'] == true)
            {
                $tableExport = true;
            }
        }

        if ($_GET['sord'] === 'asc')
        {
            $sord = 'asc'; // get the direction
        } else
        {
            $sord = 'desc'; // get the direction
        }

        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort

        if (!$sidx || !preg_match("/^\w*$/", $sidx))
        {
            $sidx = 1;
        }

        $where = ""; //if there is no search request sent by jqgrid, $where should be empty
        if ($_GET['_search'] == 'true')
        {
            $searchField = isset($_GET['filters']) ? json_decode($_GET['filters'], true) : false;
            $where = Where::getClausule($searchField, 0);
        }

        switch ($id)
        {
            case "disease-info":
                $model = new DiseaseInfoTable();
                break;
            case "human-gene-info":
                $model = new HumanGeneInfoTable();
                break;
            case "fly-gene-info":
                $model = new FlyGeneInfoTable();
                break;
            case "orthology":
                $model = new OrthologyTable();
                break;
            case "overview":
                $model = new OverviewTable();
                break;
            case "wing-screen":
                $model = new WingScreenTable();
                break;
            case "neuronal-screen":
                $model = new NeuronalScreenTable();
                break;
            case "transcription-factor":
                $model = new TranscriptionFactorTable();
                break;
            case "motif":
                $model = new MotifTable();
                break;
        }

        $where = $model->changeWhere($where);

        if (!$tableExport)
        {
            $count = $model->getCount($where);

            $page = (int) $_GET['page']; // get the requested page            

            $limit = (int) $_GET['rows']; // get how many rows we want to have into the grid        

            if ($count > 0)
            {
                $total_pages = ceil($count / $limit);
            } else
            {
                $total_pages = 0;
            }

            if ($page > $total_pages)
            {
                $page = $total_pages;
            }


            if ($page === 0)
            {
                $start = 0;
            } else
            {
                $start = $limit * $page - $limit;
            }

            $response = $model->getResponse($where, $sidx, $sord, $start, $limit);

            $response['page'] = $page;
            $response['total'] = $total_pages;
            $response['records'] = $count;

            $response['userdata'] = $model->getUserData($where);

            return json_encode($response);
        } else
        {
            $response = $model->getDownloadResponse($where, $sidx, $sord);

            if (count($response) == 0)
            {
                return $this->download_csv_results($response, $id . '.csv');
            } else
            {
                return $this->download_csv_results($response['rows'], $id . '.csv');
            }
        }
    }

    private function download_csv_results($results, $name = NULL)
    {
        if (!$name)
        {
            $name = md5(uniqid() . microtime(TRUE) . mt_rand()) . '.csv';
        }

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $name);
        header('Pragma: no-cache');
        header("Expires: 0");

        $outstream = fopen("php://output", "w");

        if (count($results) > 0)
        {
            fputcsv($outstream, array_keys($results[0]['cell']));

            foreach ($results as $result)
            {
                fputcsv($outstream, $result['cell']);
            }
        }
        
        fclose($outstream);
    }
}