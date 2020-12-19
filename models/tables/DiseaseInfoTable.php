<?php

namespace app\models\tables;

class DiseaseInfoTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        $userData['Diseases'] = $this->getNumberOfDiseases($where);
        return $userData;
    }

    private function getNumberOfHumanGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct human_gene_id) as count from ($this->sql $where)s")->queryScalar();
    }

    private function getNumberOfDiseases($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct disease_subtype) as count from ($this->sql $where)s")->queryScalar();
    }

    public function getCount($where)
    {
        return \Yii::$app->db->createCommand("select count(*) as count from ($this->sql $where )s")->queryScalar();
    }

    public function getResponse($where, $sidx, $sord, $start, $limit)
    {
        $result = \Yii::$app->db->createCommand("$this->sql $where ORDER BY $sidx $sord LIMIT $start , $limit")->queryAll();        

        $response = array();
        $i = 0;
        foreach ($result as $row)
        {
            $response['rows'][$i]['id'] = $row['human_gene_disease_id'];
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
            $where = str_replace('gene_group = "ID data freeze 650"', 'gene_group_id IN (7,8,9)', $where);
            $where = str_replace('gene_group = "Current primary ID genes"', 'gene_group_id IN (7,8,9,10)', $where);            
        }        

        return $where;
    }            

    private $sql = "SELECT distinct
                    human_gene_id,
                    human_gene_disease_id,
                    entrez_id,
                    gene_symbol,                    
                    gene_group,
                    inheritance_pattern,
                    inheritance_type,
                    main_class_type,
                    additional_class_type,
                    confidence_criteria_limit_no_patient,
                    sysid_yes_no,
                    disease_subtype,
                    disease_type,
                    alternative_names,
                    additional_references,
                    omim_disease,
                    gene_review,
                    haploinsufficiency_yes_no,
                    clinical_synopsis,
                    human_gene_disease_remark
                FROM 
                    disease ";
    
    private $sqlDownload = "SELECT
                                entrez_id as `Entrez id`,
                                gene_symbol as `Gene symbol`,
                                gene_group as `Gene group`,
                                inheritance_pattern as `Inheritance pattern`,
                                inheritance_type as `Inheritance type`,
                                main_class_type as `Main class `,
                                additional_class_type as `Accompanying phenotype`,
                                confidence_criteria_limit_no_patient as `Limited confidence criterion`,
                                sysid_yes_no as `Sysid yes no`,
                                disease_subtype as `Disease subtype`,
                                disease_type as `Disease type`,
                                alternative_names as `Alternative names`,
                                additional_references as `Additional references`,
                                omim_disease as `Omim disease`,
                                gene_review as `Gene review`,
                                haploinsufficiency_yes_no as `Haploinsufficiency yes no`,
                                clinical_synopsis as `Clinical synopsis`,
                                human_gene_disease_remark as `Human gene disease remark`
                            FROM
                                disease";
}
