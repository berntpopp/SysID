<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\views\BaseSearch;
use app\models\Where;
use app\models\views\AdvancedSearch;

class SearchController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionSearch()
    {
        if (isset($_GET['search']))
        {
            $searchQuery = trim($_GET['search']);
            
            if ($searchQuery == "" || $searchQuery == ",")
                return $this->redirect('/');
            
            $searchQuery = preg_quote($searchQuery);
                
            $search = new BaseSearch();

            $searchArr = explode(',', $searchQuery);

            $query = "";

            for ($i = 0; $i < count($searchArr); $i++)
            {
                $q = trim($searchArr[$i]);

                $query .= $q;                

                if ($i < count($searchArr) - 1)
                {
                    $query .= "|";                    
                }
            }

            $searchResult = $search->search($query);

            if (count($searchResult) == 1)
            {
                $this->redirect($searchResult[0]['link']);
            }
            else
            {
                return $this->render('search-result', array('searchResult' => $searchResult, 'count' => count($searchResult)));
            }
        }
        elseif (isset($_GET['searchQuery']))
        {
            $searchResult = array();

            $data = json_decode($_GET['searchQuery'], true);

            $searchField = array();
            $searchField['groupOp'] = 'AND';
            $searchField['rules'] = $data['qs'];

            $where = Where::getClausule($searchField, 0);

            $search = new AdvancedSearch();

            if ($data['ct'] === "Human gene")
                $searchResult = $search->searchHumanGene($where);
            else if ($data['ct'] === "Fly gene")
                $searchResult = $search->searchFlyGene($where);

            return $this->render('search-result', array('searchResult' => $searchResult, 'count' => count($searchResult)));
        }
    }

}
