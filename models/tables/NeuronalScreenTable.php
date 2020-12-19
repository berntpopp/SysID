<?php

namespace app\models\tables;

class NeuronalScreenTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        $userData['Fly genes'] = $this->getNumberOfFlyGenes($where);
        return $userData;
    }

    private function getNumberOfFlyGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct fly_gene_id) as count from ($this->sql $where)s")->queryScalar();
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
            $response['rows'][$i]['id'] = $row['id'];
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

    private $sql = "SELECT * FROM t_neuronal_screen ";
    
    private $sqlDownload = "SELECT
                        human_gene_symbol as `Human gene symbol`,
                        entrez_id as `Entrez id`,
                        gene_group as `Gene group`,
                        flybase_id as `Flybase id`,
                        fly_gene_symbol as `Fly gene symbol`,
                        cg_number as `CG number`,
                        gene_name as `Gene name`,
                        order_number as `Order number`,
                        any_phenotype as `Any phenotype`,
			early_lethality as `Early lethality`,
                        late_lethality as `Late lethality`,
                        behavioral_phenotype as `Behavioral phenotype`,
                        early_walker as `Early walker`,
                        early_sitter as `Early sitter`,
                        early_jumper as `Early jumper`,    
                        late_phenotype_general as `Late phenotype general`,
                        late_walker as `Late walker`,
                        late_sitter as `Late sitter`,
                        late_jumper as `Late jumper`,                        
                        flight_performance_evidence as `Flight performance evidence`
                        FROM t_neuronal_screen ";

}
