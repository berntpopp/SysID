<?php

namespace app\models\views;

class FlyGene
{
    public $fly_gene_id;
    public $flybase_id;
    public $gene_name;
    public $gene_symbol;
    public $gene_synonyms;
    public $secondary_flybase_ids;
    public $fly_gene_remark;
    public $cgNumbers = array();

    public function getFlyGene($pk)
    {
        $result = \Yii::$app->db->createCommand($this->sql)->bindParam(':pk', $pk)->queryOne();

        $this->fly_gene_id = $result["fly_gene_id"];
        $this->flybase_id = $result["flybase_id"];
        $this->gene_name = $result["gene_name"];
        $this->gene_symbol = $result["gene_symbol"];
        $this->gene_synonyms = $result["gene_synonyms"];
        $this->fly_gene_remark = $result["fly_gene_remark"];

        $this->cgNumbers = \Yii::$app->db->createCommand($this->cgNumbersSql)->bindParam(':pk', $pk)->queryAll();
    }

    private $sql = "select 
                    fly_gene_id AS fly_gene_id,
                    flybase_id AS flybase_id,
                    gene_name AS gene_name,
                    gene_symbol AS gene_symbol,
                    gene_synonyms AS gene_synonyms,
                    secondary_flybase_ids AS secondary_flybase_ids,
                    fly_gene_remark AS fly_gene_remark                    
                from
                    fly_gene where fly_gene_id = :pk";
    
    private $cgNumbersSql = "select 
                    cgc.cg_number_connect_id,
                    cg.cg_number_id AS cg_number_id,
                    cg.cg_number AS cg_number
                from
                    cg_number_connect cgc
                    left join cg_number cg ON cg.cg_number_id = cgc.cg_number_id
                where fly_gene_id = :pk";

}
