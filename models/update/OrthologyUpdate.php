<?php

namespace app\models\update;

use Yii;
use app\models\db\HumanFlyOrthologyEnsembl;
use app\models\db\FlyGene;
use app\models\update\FlyGeneUpdate;

class OrthologyUpdate
{

    public function UpdateDatabase()
    {
        $orthology = $this->GetOrthologs();

        $flyGenes = Yii::$app->db->createCommand("SELECT fly_gene_id, flybase_id FROM fly_gene")->queryAll();
        $flybaseToId = [];
        foreach ($flyGenes as $g)
        {
            $flybaseToId[$g['flybase_id']] = $g['fly_gene_id'];
        }
        unset($flyGenes);

        $flyGeneUpdate = new FlyGeneUpdate();

        $remark = date('Y-m-d H:i:s');
        Yii::$app->db->createCommand("DELETE FROM human_fly_orthology_ensembl WHERE human_fly_ensembl_remark != '$remark'")->execute();

        $sql = array();

        $i = 1;
        foreach ($orthology as $humanGeneId => $value)
        {
            foreach ($value as $flybaseId => $relationship)
            {
                if (!array_key_exists($flybaseId, $flybaseToId))
                {
                    $newFlyGene = new FlyGene();
                    $newFlyGene->flybase_id = $flybaseId;
                    $newFlyGene->fly_gene_remark = $remark;

                    if ($newFlyGene->save())
                    {
                        $flyGeneId = $newFlyGene->fly_gene_id;
                    }
                } else
                {
                    $flyGeneId = $flybaseToId[$flybaseId];
                }
                
                $sql[] = "($i,$humanGeneId,$flyGeneId,'$relationship','$remark')";

                $i++;
            }
        }

        Yii::$app->db->createCommand("INSERT INTO human_fly_orthology_ensembl (human_fly_orthology_ensembl_id,human_gene_id, fly_gene_id, orthology_relationship, human_fly_ensembl_remark) VALUES " .implode(',', $sql))->execute();
    }

    private function GetOrthologs()
    {
        $humanGenesCount = Yii::$app->db->createCommand("SELECT count(*) FROM human_gene")->queryScalar();

        $groups = ceil($humanGenesCount / 100);

        $data = [];

        for ($i = 0; $i < $groups; $i++)
        {
            $skip = $i * 100;
            $humanGenes = Yii::$app->db->createCommand("SELECT human_gene_id, gene_symbol FROM human_gene LIMIT $skip, 100")->queryAll();

            $symbolToId = [];
            foreach ($humanGenes as $g)
            {
                $symbolToId[$g['gene_symbol']] = $g['human_gene_id'];
            }

            unset($humanGenes);

            $symbols = array_keys($symbolToId);
            $symbolsString = implode(",", $symbols);

            $url = "http://central.biomart.org/martservice/results?query=%3C!DOCTYPE%20Query%3E%3CQuery%20client=%22true%22%20processor=%22TSV%22%20limit=%22-1%22%20header=%220%22%3E%3CDataset%20name=%22hsapiens_gene_ensembl%22%20config=%22gene_ensembl_config%22%3E%3CFilter%20name=%22hgnc_symbol%22%20value=%22$symbolsString%22%20filter_list=%22%22/%3E%3CAttribute%20name=%22homologs_external_gene_name%22/%3E%3CAttribute%20name=%22dmelanogaster_homolog_ensembl_gene%22/%3E%3CAttribute%20name=%22dmelanogaster_homolog_orthology_type%22/%3E%3C/Dataset%3E%3C/Query%3E";
            unset($symbols);
            unset($symbolsString);
            $dataText = file_get_contents($url);
            unset($url);
            $dataArray = explode("\n", $dataText);

            for ($j = 0; $j < count($dataArray) - 1; $j++)
            {
                $line = explode("\t", $dataArray[$j]);

                if ($line[2] !== "")
                {
                    $humanGeneId = $symbolToId[$line[0]];

                    if (!array_key_exists($humanGeneId, $data))
                    {
                        $data[$humanGeneId] = [];
                    }

                    $data[$humanGeneId][$line[1]] = $line[2];
                }
            }
        }

        return $data;
    }
}