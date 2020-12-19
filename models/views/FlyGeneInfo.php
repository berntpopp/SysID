<?php

namespace app\models\views;

use app\models\views\GoTerms;
use app\models\views\Orthology;
use app\models\views\FlyGene;

class FlyGeneInfo
{

    public $flyGene;
    public $goTerms;
    public $stocks = array();
    public $orthology = array();

    public function getFlyGeneInfo($pk)
    {

        $this->flyGene = new FlyGene();
        $this->flyGene->getFlyGene($pk);

        $flyGoTerms = new GoTerms();
        $this->goTerms = $flyGoTerms->getFlyGoTerms($pk);
        
        $orthology = new Orthology();
        $this->orthology['manual'] = $orthology->getFlyOrthologyManual($pk);
        $this->orthology['ensembl'] = $orthology->getFlyOrthologyEnsembl($pk);
    }



}
