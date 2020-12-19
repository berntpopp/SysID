<?php

namespace app\models\tables;

class FlyGeneInfoTable
{

    public function getUserData($where)
    {
        $userData['Fly genes'] = $this->getNumberOfFlyGenes($where);
        return $userData;
    }
    
    private function getNumberOfFlyGenes($where)
    {
        $sql = "SELECT count(distinct fly_gene_id) as count FROM t_fly_gene ";

        return \Yii::$app->db->createCommand($sql . $where)->queryScalar();
    }

    public function getCount($where)
    {
        return \Yii::$app->db->createCommand("select count(*) as count from ($this->sql $where) t")->queryScalar();
    }

    public function getResponse($where, $sidx, $sord, $start, $limit)
    {
        $result = \Yii::$app->db->createCommand("$this->sql $where ORDER BY $sidx $sord LIMIT $start , $limit")->queryAll();

        $response = array();
        $i = 0;
        foreach ($result as $row)
        {
            $response['rows'][$i]['id'] = $row['fly_gene_id'];
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

    private $sql = "SELECT * FROM t_fly_gene ";
    
    private $sqlDownload = "SELECT                    
                        flybase_id AS `Flybase id`,
                        gene_name AS `Gene name`,
                        gene_symbol AS `Gene symbol`,
                        gene_synonyms AS `Gene synonyms`,
                        secondary_flybase_ids AS `Secondary flybase ids`,
                        fly_gene_remark AS `Fly gene remark`,
                        cg_number AS `CG number`
                FROM
                    t_fly_gene ";

}
