<?php

namespace app\models\tables;

class HumanGeneInfoTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        return $userData;
    }
    
    public function getNumberOfHumanGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct human_gene_id) as count from ($this->sql $where)s")->queryScalar();
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
        if ($where != '')
        {
            $where = str_replace('gene_group LIKE "%ID data freeze 650%"', 'gene_group_id LIKE "%7%" OR gene_group_id LIKE "%8%" OR gene_group_id LIKE "%9%"', $where);
            $where = str_replace('gene_group LIKE "%Current primary ID genes%"', 'gene_group_id LIKE "%7%" OR gene_group_id LIKE "%8%" OR gene_group_id LIKE "%9%" OR gene_group_id LIKE "%10%"', $where);
        }
        
        return $where;
    }

    private $sql = "SELECT * FROM t_human_gene ";
    
    private $sqlDownload = "SELECT                       
                        entrez_id as `Entrez id`,
                        sysid_id as `SysID`,
                        chromosome_location as `Chromosome location`,
                        gene_type as `Gene type`,
                        gene_symbol as `Gene symbol`,                        
                        gene_group as `Gene group`,
                        gene_description as `Gene description`,
                        gene_synonyms as `Gene synonyms`,
                        omim_id as `Omim id`,
                        ensembl_id as `Ensembl id`,
                        hprd_id as `Hprd id`,
                        hgnc_id as `Hgnc id`,
                        hpsd as `hPSD`
                    FROM
                        t_human_gene ";

}
