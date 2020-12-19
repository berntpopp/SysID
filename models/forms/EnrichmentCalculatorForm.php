<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\DbHelper;
use app\models\Math;

/**
 * ContactForm is the model behind the contact form.
 */
class EnrichmentCalculatorForm extends Model
{
    public $geneList;
    public $background;
    public $identifier;
    public $OkValues = array();
    public $FalseValues = array();
    public $OkBackground = array();
    public $FalseBackground = array();
    public $EnrichmentResult = array();

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // gene list is required
            [['geneList', 'background'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'geneList' => 'Gene List',
        ];
    }

    public function Calculate()
    {
        $geneGroups = "7,8,9,10";

        $onlyGenes = implode(',', $this->OkBackground);

        $mainClassesGenes = DbHelper::GetMainClasses($geneGroups, null, $onlyGenes);

        $mainClasses = array();

        $entrezToSymbolDb = Yii::$app->db->createCommand("SELECT gene_symbol, entrez_id FROM human_gene;")->queryAll();

        $entrezToSymbol = [];
        foreach ($entrezToSymbolDb as $g)
        {
            $entrezToSymbol[$g['entrez_id']] = $g['gene_symbol'];
        }

        unset($entrezToSymbolDb);


        $C = count($this->OkValues);
        $D = (int) \Yii::$app->db->createCommand("SELECT count(h.human_gene_id) as `count` from human_gene h LEFT JOIN  gene_group_connect g ON h.human_gene_id = g.human_gene_id WHERE gene_group_id IN ($geneGroups) AND entrez_id in ($onlyGenes)")->queryScalar();

        foreach ($mainClassesGenes as $mc => $genes)
        {
            if ($mc !== "All")
            {
                $genesA = array_intersect($genes, $this->OkValues);
                $A = count($genesA);
                $B = count($genes);

                $enrichment = Math::Enrichment($A, $B, $C, $D);
                $pValue = Math::FisherExactTest($A, $B, $C, $D, "twoTailed");

                $mainClasses[$mc]['genes'] = $B;
                $mainClasses[$mc]['overlap'] = $A;
                $mainClasses[$mc]['enrichment'] = $enrichment;
                $mainClasses[$mc]['pValue'] = $pValue;
                $mainClasses[$mc]['oGenes'] = $this->GetSymbols($genesA, $entrezToSymbol);
            }
        }

        $this->EnrichmentResult['mainClasses'] = $mainClasses;


        $additionalClassesGenes = DbHelper::GetAdditionalClasses($geneGroups, null, $onlyGenes);

        $additionalClasses = array();

        $C = count($this->OkValues);

        foreach ($additionalClassesGenes as $ac => $genes)
        {
            $genesA = array_intersect($genes, $this->OkValues);
            $A = count($genesA);
            $B = count($genes);

            $enrichment = Math::Enrichment($A, $B, $C, $D);
            $pValue = Math::FisherExactTest($A, $B, $C, $D, "twoTailed");

            //$additionalClasses[$ac] = [$B,$A,$enrichment, $pValue];
            $additionalClasses[$ac]['genes'] = $B;
            $additionalClasses[$ac]['overlap'] = $A;
            $additionalClasses[$ac]['enrichment'] = $enrichment;
            $additionalClasses[$ac]['pValue'] = $pValue;
            $additionalClasses[$ac]['oGenes'] = $this->GetSymbols($genesA, $entrezToSymbol);
        }

        $this->EnrichmentResult['additionalClasses'] = $additionalClasses;
    }

    private function GetSymbols($entrezIds, $entrezToSymbol)
    {
        $symbols = [];

        foreach ($entrezIds as $entrez)
        {
            array_push($symbols, $entrezToSymbol[$entrez]);
        }

        return implode(',', $symbols);
    }

    public function Check()
    {
        $input = $this->getDelimitedInput($this->geneList);
        $identifier = $this->getIdentifier($input);

        if ($identifier === "Entrez id")
        {
            $this->checkEnrezs($input, false);
        } elseif ($identifier == "Gene symbol")
        {
            $this->checkSymbols($input, false);
        }

        if (count($this->FalseValues) > 0)
        {
            $this->geneList = implode(PHP_EOL, $this->OkValues);
            $this->addError("geneList");
            $this->identifier = $identifier;
            return false;
        } else
        {
            $backgroundInput = $this->getDelimitedInput($this->background);
            $backgroundIdentifier = $this->getIdentifier($backgroundInput);

            if ($backgroundIdentifier != $identifier)
            {
                $this->addError("Wrong identifiers for background!");
                return false;
            }

            if ($backgroundIdentifier === "Entrez id")
            {
                $this->checkEnrezs($backgroundInput, true);
            } elseif ($backgroundIdentifier == "Gene symbol")
            {
                $this->checkSymbols($backgroundInput, true);
            }

            if (count($this->FalseBackground) > 0)
            {
                $this->background = implode(PHP_EOL, $this->OkBackground);
                $this->addError("background");
                return false;
            }

            if ($identifier == "Gene symbol")
            {
                $this->OkValues = $this->getEntrezFromSymbol($this->OkValues);
                $this->OkBackground = $this->getEntrezFromSymbol($this->OkBackground);
            }

            $this->OkValues = array_intersect($this->OkValues, $this->OkBackground);

            if (count($this->OkBackground) < count($this->OkValues))
            {
                $this->addError("Background has to be bigger than gene list!");
                return false;
            }

            return true;
        }
    }

    private function getDelimitedInput($geneList)
    {
        $comma = substr_count($geneList, ',');
        $tab = substr_count($geneList, "\t");
        $newLine = substr_count($geneList, PHP_EOL);

        if ($comma > $tab && $comma > $newLine)
        {
            $inputList = explode(',', $geneList);
        } elseif ($tab > $comma && $tab > $newLine)
        {
            $inputList = explode("\t", $geneList);
        } elseif ($newLine >= $comma && $newLine >= $tab)
        {
            $inputList = explode(PHP_EOL, $geneList);
        }

        $inputListStriped = array();

        foreach ($inputList as $item)
        {
            if ($item != '')
            {
                array_push($inputListStriped, trim($item));
            }
        }

        return array_unique($inputListStriped);
    }

    private function getIdentifier($inputList)
    {
        $idsCount = 0;
        $textCount = 0;

        foreach ($inputList as $item)
        {
            if (is_numeric($item))
            {
                $idsCount+=1;
            } else
            {
                $textCount+=1;
            }
        }

        if ($textCount >= $idsCount)
        {
            return "Gene symbol";
        } else
        {
            return "Entrez id";
        }
    }

    private function checkEnrezs($input, $checkBeckground)
    {
        $dataFalse = array();
        $dataOK = array();

        $inputInStatement = implode("','", $input);
        $idsInDatabase = \Yii::$app->db->createCommand("SELECT entrez_id from human_gene where entrez_id in ('$inputInStatement')")->queryColumn();

        foreach ($input as $id)
        {
            if (in_array($id, $idsInDatabase))
            {
                array_push($dataOK, $id);
            } else
            {
                array_push($dataFalse, $id);
            }
        }

        if ($checkBeckground)
        {
            $this->OkBackground = $dataOK;
            $this->FalseBackground = $dataFalse;
        } else
        {
            $this->OkValues = $dataOK;
            $this->FalseValues = $dataFalse;
        }
    }

    private function checkSymbols($input, $checkBeckground = false)
    {
        $dataFalse = array();
        $dataOK = array();

        $inputInStatement = implode("','", $input);
        $idsInDatabase = \Yii::$app->db->createCommand("SELECT UPPER(gene_symbol) as gene_symbol from human_gene where gene_symbol in ('$inputInStatement')")->queryColumn();

        foreach ($input as $symbol)
        {
            if (in_array(strtoupper($symbol), $idsInDatabase))
            {
                array_push($dataOK, $symbol);
            } else
            {
                array_push($dataFalse, $symbol);
            }
        }

        if ($checkBeckground)
        {
            $this->OkBackground = $dataOK;
            $this->FalseBackground = $dataFalse;
        } else
        {
            $this->OkValues = $dataOK;
            $this->FalseValues = $dataFalse;
        }
    }

    private function getEntrezFromSymbol($geneList)
    {
        $inputInStatement = implode("','", $geneList);
        return \Yii::$app->db->createCommand("SELECT entrez_id from human_gene where gene_symbol in ('$inputInStatement')")->queryColumn();
    }

    private function getEntrezFromEntrez($geneList)
    {
        $inputInStatement = implode("','", $geneList);
        return \Yii::$app->db->createCommand("SELECT entrez_id from human_gene where entrez_id in ('$inputInStatement')")->queryColumn();
    }
}