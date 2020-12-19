<?php

namespace app\models\update;

use Yii;
use app\models\db\GoStandard;

class GoUpdate
{

    public function UpdateDatabase()
    {
        ini_set('memory_limit', '1024M');
        
        $this->DownloadGene2GoFile();

        $humanEntrezIds = $this->GetEntrezIds(9606);
        $flyEntrezIds = $this->GetEntrezIds(7227);
        $goIdToGoInfo = $this->ReadGeneToGo($humanEntrezIds, $flyEntrezIds);

        $goTermSql = array();
        $humanConnectionSql = array();
        $flyConnectionSql = array();

        Yii::$app->db->createCommand("DELETE FROM go_standard")->execute();

        $remark = date('Y-m-d H:i:s');

        $h = 1;
        $f = 1;
        foreach ($goIdToGoInfo as $goId => $goInfo)
        {
            $goStdId = $goInfo['go_std_id'];

            $goTermSql[] = "(" . $goStdId . ",'" . $goId . "','" . addslashes($goInfo['go_term']) . "'," . $goInfo['go_category_id'] . ",'" . $remark . "'," . $goInfo['go_evidence_id'] . "," . $goInfo['go_reference'] . ")";

            $humanUniqueIds = array_unique($goInfo['humanIds']);
            foreach ($humanUniqueIds as $humanId)
            {
                $humanConnectionSql[] = "($h,$humanId,$goStdId,'$remark')";
                $h++;
            }

            $flyUniqueIds = array_unique($goInfo['flyIds']);
            foreach ($flyUniqueIds as $flyId)
            {
                $flyConnectionSql[] = "($f,$flyId,$goStdId,'$remark')";
                $f++;
            }
        }

        Yii::$app->db->createCommand("INSERT INTO go_standard (go_std_id,go_id, go_term, go_category_id,go_remark,go_evidence_id,go_reference) VALUES " . implode(',', $goTermSql))->execute();
        Yii::$app->db->createCommand("INSERT INTO human_gene_go_standard_connect (human_gene_go_std_connect_id,human_gene_id, go_std_id, remark) VALUES " . implode(',', $humanConnectionSql))->execute();
        Yii::$app->db->createCommand("INSERT INTO fly_gene_go_standard_connect (fly_gene_go_std_connect_id,fly_gene_id, go_std_id, remark) VALUES " . implode(',', $flyConnectionSql))->execute();
    }

    public function ReadGeneToGo($humanEntrezToId, $flyEntrezToId)
    {
        $compressedFileName = dirname(__FILE__) . '/../../files/gene2go.gz';

        $data = array();

        $evidenceToId = $this->GetGoEvidenceDictionary();

        if (file_exists($compressedFileName))
        {
            $lines = gzfile($compressedFileName);

            array_shift($lines);

            $goStdId = 1;

            foreach ($lines as $line)
            {
                $taxId = substr($line, 0, 4);

                if ($taxId != '9606' && $taxId != '7227')
                {
                    continue;
                }

                $splitted = explode("\t", $line);
                $entrez = $splitted[1];

                if ($taxId == '9606')
                {
                    if (!array_key_exists($entrez, $humanEntrezToId))
                    {
                        continue;
                    }
                } else if ($taxId == '7227')
                {
                    if (!array_key_exists($entrez, $flyEntrezToId))
                    {
                        continue;
                    }
                }

                $goId = $splitted[2];

                if (!array_key_exists($goId, $data))
                {
                    $data[$goId] = [];

                    $data[$goId]['go_std_id'] = $goStdId++;
                    $data[$goId]['go_evidence_id'] = $evidenceToId[$splitted[3]];
                    $data[$goId]['go_term'] = $splitted[5];

                    if ($splitted[6] !== '' && $splitted[6] !== '-')
                    {
                        $data[$goId]['go_reference'] = $splitted[6];
                    } else
                    {
                        $data[$goId]['go_reference'] = 'NULL';
                    }

                    switch (trim($splitted[7]))
                    {
                        case 'Function' :
                            $data[$goId]['go_category_id'] = 1;
                            break;
                        case 'Component' :
                            $data[$goId]['go_category_id'] = 2;
                            break;
                        case 'Process' :
                            $data[$goId]['go_category_id'] = 3;
                            break;
                        default:
                            $data[$goId]['go_category_id'] = 'NULL';
                    }

                    $data[$goId]['humanIds'] = [];
                    $data[$goId]['flyIds'] = [];
                }

                if ($taxId == '9606')
                {
                    array_push($data[$goId]['humanIds'], $humanEntrezToId[$entrez]);
                } else if ($taxId == '7227')
                {
                    array_push($data[$goId]['flyIds'], $flyEntrezToId[$entrez]);
                }
            }
        }

        return $data;
    }

    private function GetEntrezIds($taxId)
    {
        if ($taxId == 9606)
        {
            $genes = Yii::$app->db->createCommand("SELECT human_gene_id, entrez_id FROM human_gene")->queryAll();

            $entrezToId = [];
            foreach ($genes as $g)
            {
                $entrezToId[$g['entrez_id']] = $g['human_gene_id'];
            }
        } else if ($taxId = 7227)
        {
            $genes = \Yii::$app->db->createCommand("select fly_gene_id,flybase_id from fly_gene")->queryAll();

            $flybaseToId = [];
            foreach ($genes as $g)
            {
                $flybaseToId[$g['flybase_id']] = $g['fly_gene_id'];
            }

            $this->DownloadFlyInfoFile();
            $entrezToId = $this->ReadFlyGeneInfo($flybaseToId);
        }

        return $entrezToId;
    }

    private function GetGoEvidenceDictionary()
    {
        $goEvidence = Yii::$app->db->createCommand("SELECT go_evidence_id, go_evidence FROM go_evidence;")->queryAll();

        $evidenceToId = [];
        foreach ($goEvidence as $g)
        {
            $evidenceToId[$g['go_evidence']] = $g['go_evidence_id'];
        }
        return $evidenceToId;
    }

    private function ReadFlyGeneInfo($flybaseToId)
    {
        $compressedFileName = dirname(__FILE__) . '/../../files/Drosophila_melanogaster.gene_info.gz';

        $data = [];

        if (file_exists($compressedFileName))
        {
            $lines = gzfile($compressedFileName);
            array_shift($lines);

            foreach ($lines as $line)
            {
                $splitted = explode("\t", $line);

                $flybaseId = substr($splitted[5], 8);

                if ($flybaseId != false && array_key_exists($flybaseId, $flybaseToId))
                {
                    $data[$splitted[1]] = $flybaseToId[$flybaseId];

                    unset($flybaseToId[$flybaseToId[$flybaseId]]);

                    if (count($flybaseToId) == 0)
                    {
                        break;
                    }
                }
            }
        }

        return $data;
    }

    public function DownloadGene2GoFile()
    {
        $url = "ftp://ftp.ncbi.nih.gov/gene/DATA/gene2go.gz";
        file_put_contents("../files/gene2go.gz", fopen($url, 'r'));
    }

    public function DownloadFlyInfoFile()
    {
        $url = "ftp://ftp.ncbi.nih.gov/gene/DATA/GENE_INFO/Invertebrates/Drosophila_melanogaster.gene_info.gz";
        file_put_contents("../files/Drosophila_melanogaster.gene_info.gz", fopen($url, 'r'));
    }
}