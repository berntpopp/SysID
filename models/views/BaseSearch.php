<?php

namespace app\models\views;

class BaseSearch
{
    public function search($query)
    {
        return \Yii::$app->db->createCommand($this->sql)->bindParam(':query', $query)->queryAll();
    }
    private $sql = "SELECT DISTINCT
                    if(t='h',concat('human-gene/',id), concat('fly-gene/',id)) as `link`,
                        `sym`,
                        `des`,
                        if(t='h','human-gene', 'fly-gene') as `t`
                        FROM
                        (SELECT 
                            human_gene_id id,
                            gene_symbol `sym`,
                            concat_ws(', ', gene_description, entrez) `des`,
                            'h' as `t`
                        FROM
                            (SELECT 
                            human_gene_id,
                            gene_symbol,
                            gene_description,
                            if(entrez_id REGEXP :query, concat_ws(' ', 'Entrez:', entrez_id), null) entrez                                
                        FROM
                            v_human_gene
                        WHERE    
                            gene_symbol REGEXP :query or entrez_id REGEXP :query or gene_synonyms REGEXP :query ORDER BY gene_symbol) h2
                        UNION SELECT 
                            fly_gene_id id,
                            flybase_id `sym`,
                            concat_ws(', ', gene_name, cg_number) `des`,
                            'f' as `t`
                        FROM
                            (SELECT 
                                f.fly_gene_id,
                                flybase_id,
                                gene_name,
                                if(cg_number REGEXP :query, concat_ws(' ', 'CG number:', cg_number), null) cg_number                                
                        FROM
                            fly_gene f
                        LEFT JOIN cg_number_connect cgc ON f.fly_gene_id = cgc.fly_gene_id
                        LEFT JOIN cg_number cg ON cgc.cg_number_id = cg.cg_number_id
                        WHERE
                            flybase_id REGEXP :query or cg_number REGEXP :query ORDER BY flybase_id) f2) t;";
}