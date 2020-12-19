<?php

namespace app\models\views;

class GoTerms
{

    public function getHumanGoTerms($pk)
    {
        return \Yii::$app->db->createCommand($this->humanGoTermsSql)->bindParam(':pk', $pk)->queryAll();
    }

    public function getFlyGoTerms($pk)
    {
        return \Yii::$app->db->createCommand($this->flyGoTermsSql)->bindParam(':pk', $pk)->queryAll();
    }

    private $humanGoTermsSql = "select 
                    human_gene_id AS id,
                    go_id AS go_id,
                    go_term AS go_term,
                    go_evidence AS go_evidence,
                    go_evidence_remark AS go_evidence_remark,
                    go_reference AS go_reference,
                    go_category AS go_category
                from
                    v_human_go_standard  
                WHERE human_gene_id = :pk
                ORDER BY go_category, go_id";
    private $flyGoTermsSql = "select 
                    fly_gene_id AS id,
                    go_id AS go_id,
                    go_term AS go_term,
                    go_evidence AS go_evidence,
                    go_evidence_remark AS go_evidence_remark,
                    go_reference AS go_reference,
                    go_category AS go_category
                from
                    v_fly_go_standard
                WHERE fly_gene_id = :pk
                ORDER BY go_category, go_id";

}
