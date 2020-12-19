<?php

namespace app\models;

class DbHelper
{

    public static function GetMainClasses($geneGroupIds, $mainClasses = null, $onlyGenes = null)
    {
        $mcClasses = array();
        
        $choosenGenes = "";
        
        if($onlyGenes!= null)
        {
            $choosenGenes = "AND entrez_id in ($onlyGenes)";
        }

        if ($mainClasses == null)
        {
            $mcClasses["1"] = array();
            $mcClasses["2"] = array();
            $mcClasses["3"] = array();
            $mcClasses["4"] = array();
            $mcClasses["5"] = array();
            $mcClasses["6"] = array();
            $mcClasses["7"] = array();
            $mcClasses["8a"] = array();
            $mcClasses["8b"] = array();
            $mcClasses["9"] = array();
            $mcClasses["SWSM"] = array();
            $mcClasses["SWOSM"] = array();
            $mcClasses["NS"] = array();
            $mcClasses["CS"] = array();
            $mcClasses["CM"] = array();
            $mcClasses["NC"] = array();
            //$mcClasses["All"] = array();
        }
        else
        {
            foreach ($mainClasses as $mc)
            {
                $mcClasses[$mc] = array();
            }
        }

        $sql = "SELECT DISTINCT entrez_id as `id`, main_class_type as `class` FROM human_gene h
                LEFT JOIN gene_group_connect ggc ON h.human_gene_id = ggc.human_gene_id                
                LEFT JOIN human_gene_disease_connect hgdc ON h.human_gene_id = hgdc.human_gene_id
                LEFT JOIN disease_subtype d on hgdc.disease_subtype_id = d.disease_subtype_id
                LEFT JOIN main_class_connect mcc on hgdc.human_gene_disease_id = mcc.human_gene_disease_id
                LEFT JOIN main_class mc on mcc.main_class_id = mc.main_class_id
                WHERE d.sysid_yes_no = 1 AND mc.main_class_type IS NOT NULL AND ggc.gene_group_id IN ($geneGroupIds) $choosenGenes";

        $genesToClasses = \Yii::$app->db->createCommand($sql)->queryAll();

        $classesInSuperclasses = array();
        $classesInSuperclasses["SWSM"] = ["1", "4", "7"];
        $classesInSuperclasses["SWOSM"] = ["2", "5", "8a", "8b"];
        $classesInSuperclasses["NS"] = ["3", "6", "9"];
        $classesInSuperclasses["CS"] = ["1", "2", "3"];
        $classesInSuperclasses["CM"] = ["4", "5", "6"];
        $classesInSuperclasses["NC"] = ["7", "8a", "8b", "9"];
        //$classesInSuperclasses["All"] = ["1", "2", "3", "4", "5", "6", "7", "8a", "8b", "9"];

        foreach ($mcClasses as $mc => $genes)
        {
            if (isset($classesInSuperclasses[$mc]))
            {
                foreach ($genesToClasses as $value)
                {
                    if (in_array($value["class"], $classesInSuperclasses[$mc]))
                    {
                        array_push($mcClasses[$mc], (int) $value["id"]);
                    }
                }
            }
            else
            {
                foreach ($genesToClasses as $value)
                {
                    if ($value["class"] == $mc)
                    {
                        array_push($mcClasses[$mc], (int) $value["id"]);
                    }
                }
            }

            foreach ($mcClasses as $mc => $genes)
            {
                $mcClasses[$mc] = array_unique($genes);
            }
        }

        return $mcClasses;
    }

    public static function GetAdditionalClasses($geneGroupIds, $additionalClasses = null, $onlyGenes = null)
    {
        $acClasses = array();
        
        if($onlyGenes!= null)
        {
            $choosenGenes = "AND entrez_id in ($onlyGenes)";
        }

        if ($additionalClasses == null)
        {
            $additionalClasses = \Yii::$app->db->createCommand("SELECT additional_class_type FROM additional_class")->queryColumn();
        }

        foreach ($additionalClasses as $ac)
        {
            $acClasses[$ac] = array();
        }


        $sql = "SELECT DISTINCT entrez_id as `id`, additional_class_type as `class` FROM human_gene h
                LEFT JOIN gene_group_connect ggc ON h.human_gene_id = ggc.human_gene_id                
                LEFT JOIN human_gene_disease_connect hgdc ON h.human_gene_id = hgdc.human_gene_id
                LEFT JOIN disease_subtype d on hgdc.disease_subtype_id = d.disease_subtype_id
                LEFT JOIN additional_class_connect acc on hgdc.human_gene_disease_id = acc.human_gene_disease_id
                LEFT JOIN additional_class ac on acc.additional_class_id = ac.additional_class_id
                WHERE d.sysid_yes_no = 1 AND ac.additional_class_type IS NOT NULL AND ggc.gene_group_id IN ($geneGroupIds) $choosenGenes";

        $genesToClasses = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($acClasses as $ac => $genes)
        {
            foreach ($genesToClasses as $value)
            {
                if ($value["class"] == $ac)
                {
                    array_push($acClasses[$ac], (int) $value["id"]);
                }
            }

            foreach ($acClasses as $ac => $genes)
            {
                $acClasses[$ac] = array_unique($genes);
            }
        }

        return $acClasses;
    }

}
