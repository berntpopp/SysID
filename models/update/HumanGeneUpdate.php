<?php

namespace app\models\update;

use Yii;
use app\models\db\HumanGene;

class HumanGeneUpdate
{
    public function LoadGenes($entrezToId)
    {
        $data = $this->readData($entrezToId);

        if (count($data) > 0)
        {
            $hpsdDict = $this->getHpsdDictionary();

            foreach ($data as $key => $value)
            {
                $data[$key]["hpsd"] = array_key_exists($value['entrez_id'], $hpsdDict) ? 1 : 0;
            }
        }

        return $data;
    }

    public function UpdateDatabase()
    {
        $this->DownloadGeneInfoFile();
        
        $genes = Yii::$app->db->createCommand("SELECT human_gene_id, entrez_id FROM human_gene;")->queryAll();

        $entrezToIds = [];
        foreach ($genes as $g)
        {
            $entrezToIds[$g['entrez_id']] = $g['human_gene_id'];
        }

        $humanGeneInfo = $this->LoadGenes($entrezToIds);

        foreach ($humanGeneInfo as $key => $value)
        {
            $humanGene = HumanGene::findOne($key);

            $humanGene->load(["HumanGene" => $value]);
            $humanGene->save();            
        }
    }

    private function getGeneTypeDictionary()
    {
        $types = Yii::$app->db->createCommand("SELECT gene_type_id, gene_type FROM gene_type;")->queryAll();
        $typesDict = array();
        foreach ($types as $type)
        {
            $typesDict[$type['gene_type']] = $type['gene_type_id'];
        }
        return $typesDict;
    }

    private function getHpsdDictionary()
    {
        $myfile = fopen(dirname(__FILE__) . '/../../files/hPSD.txt', "r") or die("Unable to open file!");
        $data = array();

        while (!feof($myfile))
        {
            $value = fgets($myfile);
            $data[rtrim($value)] = true;
        }
        fclose($myfile);
        return $data;
    }

    private function readData($entrezToId)
    {
        $compressedFileName = dirname(__FILE__) . '/../../files/Homo_sapiens.gene_info.gz';

        $data = [];

        if (file_exists($compressedFileName))
        {
            $lines = gzfile($compressedFileName);
            array_shift($lines);

            $geneType = $this->getGeneTypeDictionary();

            foreach ($lines as $line)
            {
                $splitted = explode("\t", $line);

                $entrez = $splitted[1];

                if (array_key_exists($entrez, $entrezToId))
                {
                    $info = array();

                    $info['gene_symbol'] = $splitted[10];
                    $info['gene_synonyms'] = str_replace("|", ", ", $splitted[4]);

                    if ($splitted[7] !== '-' && $splitted[7] !== '')
                    {
                        $info['chromosome_location'] = $splitted[7];
                    }

                    if (array_key_exists($splitted[9], $geneType))
                    {
                        $info['gene_type_id'] = $geneType[$splitted[9]];
                    } else
                    {
                        $info['gene_type_id'] = $geneType["unknown"];
                    }

                    $info['gene_description'] = $splitted[11];
                    $info['entrez_id'] = $entrez;

                    $refs = explode("|", $splitted[5]);
                    foreach ($refs as $ref)
                    {
                        $r = explode(":", $ref);

                        switch ($r[0])
                        {
                            case "MIM":
                                if ($r[1] !== '-' && $r[1] !== '')
                                {
                                    $info['omim_id'] = $r[1];
                                }
                                break;
                            case "Ensembl":
                                if ($r[1] !== '-' && $r[1] !== '')
                                {
                                    $info['ensembl_id'] = $r[1];
                                }
                                break;
                            case "HPRD":
                                if ($r[1] !== '-' && $r[1] !== '')
                                {
                                    $info['hprd_id'] = $r[1];
                                }
                                break;
                            case "HGNC":
                                $r3 = count($r) === 2 ? $r[1] : $r[2];
                                if ($r3 !== '-' && $r3 !== '')
                                {
                                    $info['hgnc_id'] = $r3;
                                }
                                break;
                            default:
                                break;
                        }
                    }

                    $data[$entrezToId[$entrez]] = $info;
                    unset($entrezToId[$entrez]);

                    if (count($entrezToId) == 0)
                    {
                        break;
                    }
                }
            }
        }

        return $data;
    }

    public function DownloadGeneInfoFile()
    {
        $url = "ftp://ftp.ncbi.nih.gov/gene/DATA/GENE_INFO/Mammalia/Homo_sapiens.gene_info.gz";
        file_put_contents("../files/Homo_sapiens.gene_info.gz", fopen($url, 'r'));
    }

    static public function getNcbiFileInfoDate()
    {
        $filename = dirname(__FILE__) . '/../../files/Homo_sapiens.gene_info.gz';
        if (file_exists($filename))
        {
            return date("d/m/Y", filemtime($filename));
        } else
        {
            return '';
        }
    }
}