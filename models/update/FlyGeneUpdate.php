<?php

namespace app\models\update;

use Yii;
use app\models\db\FlyGene;
use app\models\db\CGNumberConnect;
use app\models\db\CGNumber;

class FlyGeneUpdate
{

    public function UpdateDatabase()
    {
        $flyGenesCount = Yii::$app->db->createCommand("SELECT count(*) FROM fly_gene where fly_gene_id != 275")->queryScalar();         

        $groups = ceil($flyGenesCount / 100);        

        for ($i = 0; $i < $groups; $i++)
        {
            $skip = $i * 100;

            $genes = Yii::$app->db->createCommand("SELECT fly_gene_id, flybase_id FROM fly_gene where fly_gene_id != 275 LIMIT $skip, 100")->queryAll();

            $flybaseToIdDictionary = [];

            foreach ($genes as $value)
            {
                $flybaseToIdDictionary[$value["flybase_id"]] = $value["fly_gene_id"];
            }

            unset($genes);

            $flyGeneInfo = $this->LoadGenes($flybaseToIdDictionary);

            foreach ($flyGeneInfo as $key => $value)
            {
                $flyGene = FlyGene::findOne($key);

                $flyGene->load(["FlyGene" => $value]);
                $flyGene->save();
                
                $this->addCgNumbers($flyGene, ["FlyGene" => $value]);                
            }
        }
    }

    public function LoadGenes($flybaseToId)
    {
        $flybaseIds = array_keys($flybaseToId);
        $flybaseIdsString = implode("+", $flybaseIds);
        $url = "http://flybase.org/cgi-bin/fbidbatch.html?fields=SYMBOL&fields=NAME&fields=FBID_KEY&fields=SYMBOL_SYNONYMS&fields=SECONDARY_IDS&fields=ANNOTATION_SYMBOL&idlist=$flybaseIdsString&dbname=fbgn&sel=fields&allow_syn=&format3=tsv_file&saveas=Browser";
        unset($flybaseIds);
        unset($flybaseIdsString);
        $dataText = file_get_contents($url);
        unset($url);
        $dataArray = explode("\n", $dataText);

        $data = [];

        for ($i = 1; $i < count($dataArray); $i++)
        {
            $line = explode("\t", $dataArray[$i]);

            if (count($line) == 7)
            {
                $info = [];
                $info['flybase_id'] = $line[1];
                $info['cgNumbers'] = $line[2];
                $info['gene_name'] = $line[3];
                $info['secondary_flybase_ids'] = str_replace(" <newline> ", ", ", $line[4]);
                $info['gene_symbol'] = $line[5];
                $info['gene_synonyms'] = str_replace(" <newline> ", ", ", $line[6]);

                $data[$flybaseToId[$line[1]]] = $info;
            }
        }

        return $data;
    }
    
    private function addCgNumbers($model, $request)
    {
        $modelGroups = $model->cgNumbers;
        if (!isset($request['FlyGene']['cgNumbers']) || (isset($request['FlyGene']['cgNumbers']) && $request['FlyGene']['cgNumbers'] == ''))
            $requestGroups = array();
        else
            $requestGroups = explode(',', $request['FlyGene']['cgNumbers']);

        $allItems = CGNumber::getAllCgNumbersAndIds();

        foreach ($modelGroups as $key => $value)
        {
            $found = false;
            foreach ($requestGroups as $rId)
            {
                if (!isset($allItems[$rId]))
                {
                    $found = true;
                    break;
                } else
                {
                    $id = $allItems[$rId];
                    if ($value['cg_number_id'] == $id)
                    {
                        $found = true;
                        break;
                    }
                }
            }

            if ($found == false)
            {
                $model->unlink('cgNumbers', $value, true);
            }
        }

        foreach ($requestGroups as $rId)
        {
            $found = false;
            if (isset($allItems[$rId]))
            {
                $id = $allItems[$rId];
                foreach ($modelGroups as $key => $value)
                {
                    if ($value['cg_number_id'] == $id)
                    {
                        $found = true;
                        break;
                    }
                }
            } else
            {
                $newItem = new CGNumber();
                $newItem->cg_number = $rId;
                $newItem->save();
                $id = $newItem->cg_number_id;
            }

            if ($found == false)
            {
                $newConnect = new CGNumberConnect();
                $newConnect->cg_number_id = $id;
                $newConnect->fly_gene_id = $model->fly_gene_id;                
                $newConnect->validate();
                $newConnect->save();
            }
        }
    }
}