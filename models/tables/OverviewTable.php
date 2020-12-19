<?php

namespace app\models\tables;

class OverviewTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        $userData['Fly genes'] = $this->getNumberOfFlyGenes($where);
        $userData['Diseases'] = $this->getNumberOfDiseases($where);
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

    private function getNumberOfDiseases($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct disease_subtype) as count from ($this->sql $where)s")->queryScalar();
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
        if ($where != '')
        {
            $where = str_replace('gene_symbol', 'gene_symbol', $where);
            $where = str_replace('gene_group = "ID data freeze 650"', 'gene_group_id IN (7,8,9)', $where);
            $where = str_replace('gene_group = "Current primary ID genes"', 'gene_group_id IN (7,8,9,10)', $where);            
        }        

        return $where;
    }

    private $sql = "SELECT DISTINCT
                        id,
                        human_gene_id,
                        entrez_id,
                        sysid_id,
                        chromosome_location,
                        gene_type,
                        gene_symbol,
                        gene_group,
                        gene_description,
                        super_go,
                        hpsd,
                        fly_gene_id AS fly_gene_id,
                        flybase_id AS flybase_id,
                        gene_name AS gene_name,
                        orthology_determination,
                        wing_phenotype_overview,
                        neuronal_phenotype_overview,
                        human_gene_disease_id,
                        inheritance_pattern,
                        inheritance_type,
                        main_class_type,
                        additional_class_type,
                        confidence_criteria_limit_no_patient,
                        sysid_yes_no,
                        disease_subtype,
                        disease_type,
                        additional_references,
                        omim_disease,
                        haploinsufficiency_yes_no,
                        clinical_synopsis
                    FROM
                        overview ";
    
    private $sqlDownload = "SELECT
                                entrez_id as `Entrez id`,
                                sysid_id as `SysID`,
                                chromosome_location as `Chromosome location`,
                                gene_type as `Gene type`,
                                gene_symbol as `Gene symbol`,                        
                                gene_group as `Gene group`,
                                gene_description as `Gene description`,
                                super_go as `Super go`,
                                hpsd as `Hpsd`,
                                flybase_id AS `Flybase id`,
                                gene_name AS `Gene name`,
                                orthology_determination AS `Orthology determination`,
                                wing_phenotype_overview AS `Wing phenotype overview`,
                                neuronal_phenotype_overview AS `Neuronal phenotype overview`,
                                inheritance_pattern as `Inheritance pattern`,
                                inheritance_type as `Inheritance type`,
                                main_class_type as `Main class `,
                                additional_class_type as `Accompanying phenotype`,
                                confidence_criteria_limit_no_patient as `Limited confidence criterion`,
                                sysid_yes_no as `Sysid yes no`,
                                disease_subtype as `Disease subtype`,
                                disease_type as `Disease type`,                        
                                omim_disease as `Omim disease`,                        
                                haploinsufficiency_yes_no as `Haploinsufficiency yes no`,
                                clinical_synopsis as `Clinical synopsis`
                            FROM
                                overview";

}
