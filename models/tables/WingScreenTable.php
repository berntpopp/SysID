<?php

namespace app\models\tables;

class WingScreenTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getNumberOfHumanGenes($where);
        $userData['Fly genes'] = $this->getNumberOfFlyGenes($where);
        return $userData;
    }

    private function getNumberOfFlyGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct fly_gene_id) as count from ($this->sql $where)s")->queryScalar();
    }

    private function getNumberOfHumanGenes($where)
    {
        return \Yii::$app->db->createCommand("select count(distinct human_gene_id) as count from ($this->sql $where)s")->queryScalar();
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
        return $where;
    }

    private $sql = "SELECT * FROM t_wing_screen ";
    
    private $sqlDownload = "SELECT 
                        human_gene_symbol as `Human gene symbol`,
                        entrez_id as `Entrez id`,
                        gene_group as `Gene group`,
                        flybase_id as `Flybase id`,
                        fly_gene_symbol as `Fly gene symbol`,
                        cg_number as `CG number`,
                        gene_name as `Gene name`,
                        order_number as `Order number`,
                        any_phenotype as `Any phenotype`,
			lethality as `Lethality`,
                        wing_shape_growth_overview as `Wing shape growth overview`,
                        wing_shape_curled_cupped as `Wing shape curled cupped`,
                        wing_shape_size as `Wing shape size`,
                        wing_shape_adhesion_severity as `Wing shape adhesion severity`,
			wing_inteveincell_posterior_wing_margin_overview as `Wing inteveincell posterior wing margin overview`,
                        wing_interveincell_disruption_notched as `Wing interveincell disruption notched`,
                        wing_inerveincell_non_innervated_hairs_missing as `Wing inerveincell non innervated_hairs missing`,
                        wing_interveincell_polarity_hairs_overview as `Wing interveincell polarity hairs overview`,
                        wing_interveincell_hairs_missing as `Wing interveincell hairs missing`,
                        wing_interveincell_hair_density as `Wing interveincell hair density`,
                        wing_interveincell_hairs_disorganized as `Wing interveincell hairs disorganized`,
                        wing_interveincell_hair_morphology as `Wing interveincell hair morphology`,
                        wing_interveincell_pigmented_spots as `Wing interveincell pigmented spots`,
                        wing_noninterveincell_veins_overview as `Wing noninterveincell veins overview`,
                        wing_noninterveincell_veins_missing as `Wing noninterveincell veins_missing`,
                        wing_noninterveincell_extra_veins as `Wing noninterveincell extra_veins`,
                        wing_noninterveincell_sensoryorgan_overview as `Wing noninterveincell sensoryorgan overview`
                        FROM t_wing_screen ";
}
