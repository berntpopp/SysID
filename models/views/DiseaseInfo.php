<?php

namespace app\models\views;

class DiseaseInfo
{
    public $human_gene_disease_id;
    public $human_gene_id;
    public $disease_subtype_id;
    public $inheritance_pattern_id;
    public $inheritance_type_id;
    public $inheritance_pattern;
    public $inheritance_type;
    public $haploinsufficiency_yes_no;
    public $confidence_criteria_limit_no_patient;
    public $alternative_names;
    public $additional_references = array();
    public $clinical_synopsis;
    public $date_of_entry;
    public $entry_user_id;
    public $date_of_update;
    public $update_user_id;
    public $human_gene_disease_remark;
    public $disease_subtype;
    public $disease_type_id;
    public $omim_disease;
    public $sysid_yes_no;
    public $disease_subtype_remark;
    public $disease_type;
    public $disease_type_remark;
    public $mainClasses = array();
    public $additionalClasses = array();
    public $geneReviews = array();

    public function getDiseaseInfoByPk($pk)
    {
        $result = \Yii::$app->db->createCommand($this->sql)->bindParam(':pk', $pk)->queryOne();

        $this->human_gene_disease_id = $result["human_gene_disease_id"];
        $this->human_gene_id = $result["human_gene_id"];
        $this->disease_subtype_id = $result["disease_subtype_id"];
        $this->inheritance_pattern_id = $result["inheritance_pattern_id"];
        $this->inheritance_pattern = $result["inheritance_pattern"];
        $this->inheritance_type_id = $result["inheritance_type_id"];
        $this->inheritance_type = $result["inheritance_type"];
        $this->haploinsufficiency_yes_no = $result["haploinsufficiency_yes_no"];
        $this->confidence_criteria_limit_no_patient = $result["confidence_criteria_limit_no_patient"];
        $this->alternative_names = $result["alternative_names"];
        $this->additional_references = explode(",", $result["additional_references"]);
        $this->clinical_synopsis = $result["clinical_synopsis"];
        $this->date_of_entry = $result["date_of_entry"];
        $this->date_of_entry_credit_id = $result["entry_user_id"];
        $this->date_of_update = $result["date_of_update"];
        $this->date_of_update_credit_id = $result["update_user_id"];
        $this->disease_subtype = $result["disease_subtype"];
        $this->disease_type_id = $result["disease_type_id"];
        $this->disease_type = $result["disease_type"];
        $this->omim_disease = $result["omim_disease"];
        $this->sysid_yes_no = $result["sysid_yes_no"];
        //$this->disease_subtype_remark = $result["disease_subtype_remark"];
        $this->omim_disease = $result["omim_disease"];
        //$this->disease_type_remark = $result["disease_type_remark"];        

        $this->additionalClasses = \Yii::$app->db->createCommand($this->additionalClassesSql)->bindParam(':pk', $pk)->queryAll();
        $this->mainClasses = \Yii::$app->db->createCommand($this->mainClassesSql)->bindParam(':pk', $pk)->queryAll();
        $this->geneReviews = \Yii::$app->db->createCommand($this->geneReviewsSql)->bindParam(':pk', $pk)->queryAll();        
    }

    private $sql = "SELECT 
                    hgdc.human_gene_id,
                    hgdc.human_gene_disease_id,
                    ip.inheritance_pattern_id,
                    ip.inheritance_pattern,
                    it.inheritance_type_id,
                    it.inheritance_type,
                    hgdc.confidence_criteria_limit_no_patient,
                    ds.sysid_yes_no,
                    hgdc.disease_subtype_id,
                    ds.disease_subtype,
                    ds.disease_type_id,
                    dt.disease_type,
                    hgdc.alternative_names,
                    hgdc.additional_references,
                    ds.omim_disease,                    
                    hgdc.haploinsufficiency_yes_no,
                    hgdc.clinical_synopsis,
                    hgdc.date_of_entry,
                    hgdc.entry_user_id,
                    hgdc.date_of_update,
                    hgdc.update_user_id,                    
                    hgdc.human_gene_disease_remark
                FROM
                    human_gene_disease_connect hgdc
                        LEFT JOIN
                    inheritance_pattern ip ON ip.inheritance_pattern_id = hgdc.inheritance_pattern_id
                        LEFT JOIN
                    inheritance_type it ON it.inheritance_type_id = hgdc.inheritance_type_id
                        LEFT JOIN
                    disease_subtype ds ON hgdc.disease_subtype_id = ds.disease_subtype_id
                        LEFT JOIN
                    disease_type dt ON ds.disease_type_id = dt.disease_type_id
                WHERE hgdc.human_gene_disease_id = :pk";
    
    private $additionalClassesSql = "SELECT
                acc.human_gene_disease_id,
                acc.confidence_criteria_limit_clinical_desc,
                acc.additional_class_id,
                if(confidence_criteria_limit_clinical_desc = 1, concat('(', ac.additional_class_type,')'),ac.additional_class_type) additional_class_type,
                ac.additional_class_description
              FROM
                additional_class_connect acc
                left join additional_class ac on ac.additional_class_id = acc.additional_class_id
              WHERE acc.human_gene_disease_id = :pk
              ORDER BY ac.additional_class_type";
    
    private $mainClassesSql = "SELECT
                mcc.human_gene_disease_id,                
                mcc.main_class_id,
                mc.main_class_type,
                mc.main_class_description
              FROM
                main_class_connect mcc
                left join main_class mc on mc.main_class_id = mcc.main_class_id
              WHERE mcc.human_gene_disease_id = :pk
              ORDER BY mc.main_class_type";
    
    private $geneReviewsSql = "SELECT
                rc.human_gene_disease_id,                
                rc.gene_review_id,
                r.gene_review                
              FROM
                gene_review_connect rc
                left join gene_review r on r.gene_review_id = rc.gene_review_id
              WHERE rc.human_gene_disease_id = :pk";

}
