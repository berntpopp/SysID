<?php

namespace app\models\views;

class Orthology
{

    public function getHumanOrthologyManual($pk)
    {
        return \Yii::$app->db->createCommand($this->orthologyManualSql . " and h.human_gene_id = :pk")->bindParam(':pk', $pk)->queryAll();
    }

    public function getHumanOrthologyEnsembl($pk)
    {
        return \Yii::$app->db->createCommand($this->orthologyEnsemblSql . " and h.human_gene_id = :pk")->bindParam(':pk', $pk)->queryAll();
    }

    public function getFlyOrthologyManual($pk)
    {
        return \Yii::$app->db->createCommand($this->orthologyManualSql . " and f.fly_gene_id = :pk")->bindParam(':pk', $pk)->queryAll();
    }

    public function getFlyOrthologyEnsembl($pk)
    {
        return \Yii::$app->db->createCommand($this->orthologyEnsemblSql . " and f.fly_gene_id = :pk")->bindParam(':pk', $pk)->queryAll();
    }

    private $orthologyManualSql = "SELECT
                    h.human_gene_id AS human_gene_id,    
                    h.gene_symbol AS human_gene_symbol,    
                    ors.orthology_relationship AS orthology_relationship,                    
                    f.fly_gene_id AS fly_gene_id,
                    f.flybase_id AS flybase_id   
                FROM
                    human_gene h
                    left join human_fly_orthology_manual hf ON hf.human_gene_id = h.human_gene_id
                    left join orthology_relationship ors ON ors.orthology_relationship_id = hf.orthology_relationship_id
                    left join fly_gene f ON f.fly_gene_id = hf.fly_gene_id    
                WHERE orthology_source_id=2 AND to_be_investigated_2013 = 1";
    
    private $orthologyEnsemblSql = "select
                    h.human_gene_id AS human_gene_id,    
                    h.gene_symbol AS human_gene_symbol,
                    hf.orthology_relationship AS orthology_relationship,
                    f.fly_gene_id AS fly_gene_id,
                    f.flybase_id AS flybase_id   
                from
                    human_gene h
                    join human_fly_orthology_ensembl hf ON hf.human_gene_id = h.human_gene_id    
                    join fly_gene f ON f.fly_gene_id = hf.fly_gene_id";

}
