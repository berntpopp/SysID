<?php

namespace app\models\tables;

class OrthologyTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        $userData['Fly genes'] = $this->getNumberOfFlyGenes($where);
        return $userData;
    }

    private function getNumberOfHumanGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct human_gene_id) as count from ($this->sql $where)s")->queryScalar();
    }

    private function getNumberOfFlyGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct fly_gene_id) as count from ($this->sql $where)s")->queryScalar();
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
            $response['rows'][$i]['id'] = $row['orthology_id'];
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

    private $sql = "SELECT
                        orthology_id,
                        human_gene_id,
                        gene_symbol,
                        orthology_relationship,
                        fly_gene_id,
                        flybase_id,                        
                        orthology_determination
                    FROM t_orthology ";
    
    private $sqlDownload = "SELECT                        
                                gene_symbol as `Gene symbol`,
                                orthology_relationship as `Orthology relationship`,                        
                                flybase_id as `Flybase id`,                                
                                orthology_determination as `Orthology determination`
                            FROM t_orthology ";
}
