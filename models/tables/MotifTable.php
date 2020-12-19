<?php

namespace app\models\tables;

class MotifTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        return $userData;
    }

    private function getNumberOfHumanGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct human_gene_id) as count from ($this->sql $where)s")->queryScalar();
    }

    public function getCount($where)
    {
        return \Yii::$app->db->createCommand("select count(*) as count from ($this->sql $where)s")->queryScalar();
    }

    public function getResponse($where, $sidx, $sord, $start, $limit)
    {
        $result = \Yii::$app->db->createCommand("$this->sql $where ORDER BY $sidx $sord LIMIT $start , $limit")->queryAll();

        $response = array();
        $i = 0;
        foreach ($result as $row)
        {
            $response['rows'][$i]['id'] = $row['human_gene_id'];
            $response['rows'][$i]['cell'] = $row;
            $i++;
        }
        return $response;
    }

    public function getDownloadResponse($where, $sidx, $sord)
    {
        $result = \Yii::$app->db->createCommand("$this->sqlDownload $where ORDER BY $sidx $sord")->queryAll();

        $response = array();
        $i = 0;
        foreach ($result as $row)
        {
            $response['rows'][$i]['cell'] = $row;
            $i++;
        }
        return $response;
    }

    public function changeWhere($where)
    {
        return $where;
    }

    private $sql = "SELECT * FROM motifs ";
    private $sqlDownload = "SELECT gene_symbol as `Gene symbol`, `motifs` as Motifs, score as Score FROM motifs ";

}
