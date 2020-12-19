<?php

namespace app\models\views;

use app\models\views\HumanGene;
use app\models\views\GoTerms;
use app\models\views\Orthology;
use app\models\views\DiseaseInfo;
use app\models\update\HumanGeneUpdate;

class HumanGeneInfo {

    public $humanGene;
    public $goTerms;
    public $diseases = array();
    public $orthology = array();
    public $date;

    public function getHumanGeneInfo($pk) {

        $this->humanGene = new HumanGene();
        $this->humanGene->getHumanGene($pk);

        $humanGoTerms = new GoTerms();
        $this->goTerms = $humanGoTerms->getHumanGoTerms($pk);

        $diseaseIds = $this->getDiseases($pk);

        for ($i = 0; $i < count($diseaseIds); $i++) {
            $di = new DiseaseInfo();
            $di->getDiseaseInfoByPk($diseaseIds[$i]['human_gene_disease_id']);
            $this->diseases[$di->human_gene_disease_id] = $di;
        }

        $orthology = new Orthology();
        $this->orthology['manual'] = $orthology->getHumanOrthologyManual($pk);
        $this->orthology['ensembl'] = $orthology->getHumanOrthologyEnsembl($pk);
        $this->date = HumanGeneUpdate::getNcbiFileInfoDate();
    }

    private function getDiseases($pk) {
        $sql = "SELECT human_gene_disease_id FROM human_gene_disease_connect WHERE human_gene_id = :pk";
        return \Yii::$app->db->createCommand($sql)->bindParam(':pk', $pk)->queryAll();
    }
}
