<?php

namespace app\models\views;

class AdvancedSearch
{

    public function searchHumanGene($where)
    {

        $result = \Yii::$app->db->createCommand($this->humanSql . $where)->queryAll();
        return $result;
    }

    public function searchFlyGene($where)
    {

        if ($where != '')
        {

            $where .= ' AND f.fly_gene_id !=275';
        }
        else
        {
            $where = 'WHERE f.fly_gene_id !=275';
        }

        $result = \Yii::$app->db->createCommand($this->flySql . $where)->queryAll();
        return $result;
    }

    private $humanSql = "SELECT DISTINCT
                            concat('human-gene/', h.human_gene_id) as link,
                            gene_symbol `sym`,
                            gene_description `des`,
                            'human-gene' as `t`
                        FROM
                            v_human_gene h
                                LEFT JOIN
                            v_disease_info d ON d.human_gene_id = h.human_gene_id
                                LEFT JOIN
                            v_human_go_standard s on s.human_gene_id=h.human_gene_id ";
    private $flySql = "SELECT DISTINCT
		                concat('fly-gene/', f.fly_gene_id) as link,
                                flybase_id `sym`,
                                gene_name `des`,
                                'fly-gene' as `t`
                        FROM
	                        v_fly_gene_to_cross f
                        LEFT JOIN
	                        v_fly_go_standard s ON s.fly_gene_id = f.fly_gene_id ";

}
