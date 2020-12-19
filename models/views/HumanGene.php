<?php

namespace app\models\views;

class HumanGene
{
    public $human_gene_id;
    public $sysid_id;
    public $chromosome_location;
    public $gene_type_id;
    public $gene_type;
    public $gene_symbol;
    public $gene_description;
    public $gene_synonyms;
    public $entrez_id;
    public $omim_id;
    public $ensembl_id;
    public $hprd_id;
    public $hgnc_id;
    public $hpsd;
    public $gene_group_id;
    public $gene_group;
    public $super_go;

    public function getHumanGene($pk)
    {
        $result = \Yii::$app->db->createCommand($this->sql)->bindParam(':pk', $pk)->queryOne();

        $this->human_gene_id = $result["human_gene_id"];
        $this->sysid_id = $result["sysid_id"];
        $this->chromosome_location = $result["chromosome_location"];
        $this->gene_type_id = $result["gene_type_id"];
        $this->gene_type = $result["gene_type"];
        $this->gene_symbol = $result["gene_symbol"];
        $this->gene_group_id = $result["gene_group_id"];
        $this->gene_group = $result["gene_group"];
        $this->gene_description = $result["gene_description"];
        $this->gene_synonyms = $result["gene_synonyms"];
        $this->entrez_id = $result["entrez_id"];
        $this->omim_id = $result["omim_id"];
        $this->ensembl_id = $result["ensembl_id"];
        $this->hprd_id = $result["hprd_id"];
        $this->hgnc_id = $result["hgnc_id"];
        $this->hpsd = $result["hpsd"];
        $this->super_go = $result["super_go"];
    }

    private $sql = "select 
                    h.human_gene_id AS human_gene_id,
                    h.entrez_id AS entrez_id,
                    h.sysid_id AS sysid_id,                    
                    h.chromosome_location AS chromosome_location,
                    gt.gene_type_id AS gene_type_id,
                    gt.gene_type AS gene_type,
                    h.gene_symbol AS gene_symbol,
                    gg.gene_group_id AS gene_group_id,
                    group_concat(if(gg.gene_group = 'ID data freeze 518','ID data freeze 650',gg.gene_group) separator ', ') as gene_group,
                    h.gene_description AS gene_description,
                    h.gene_synonyms AS gene_synonyms,
                    h.omim_id AS omim_id,
                    h.ensembl_id AS ensembl_id,
                    h.hprd_id AS hprd_id,
                    h.hgnc_id AS hgnc_id,
                    h.hpsd,
                    sg.super_go
                from
                    human_gene h                    
                    left join gene_type gt ON gt.gene_type_id = h.gene_type_id
                    left join gene_group_connect hggc ON hggc.human_gene_id = h.human_gene_id
                    left join gene_group gg ON gg.gene_group_id = hggc.gene_group_id
                    left join (select h.human_gene_id, group_concat(super_go order by super_go separator ', ') as super_go
                                from human_gene h
                                join super_go_connect gc on gc.human_gene_id=h.human_gene_id and super_go_connection_type = 'M'
                                join super_go g on g.super_go_id=gc.super_go_id
                                group by h.human_gene_id) sg on sg.human_gene_id = h.human_gene_id
                where h.human_gene_id = :pk
                group by h.human_gene_id";

}
