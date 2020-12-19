<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "human_gene".
 *
 * @property integer $human_gene_id
 * @property integer $entrez_id
 * @property string $sysid_id
 * @property string $chromosome_location
 * @property integer $gene_type_id
 * @property string $gene_symbol
 * @property string $gene_description
 * @property string $gene_synonyms
 * @property string $omim_id
 * @property string $ensembl_id
 * @property string $hprd_id
 * @property string $hgnc_id
 * @property integer $hpsd
 * @property string $human_gene_remark
 *
 * @property GeneGroup[] $geneGroups
 * @property GeneGroupConnect[] $geneGroupConnects
 * @property HumanFlyOrthologyEnsembl[] $humanFlyOrthologyEnsembls
 * @property HumanFlyOrthologyManual[] $humanFlyOrthologyManuals
 * @property GeneType $geneType
 * @property HumanGeneDiseaseConnect[] $humanGeneDiseaseConnects
 * @property HumanGeneGoStandardConnect[] $humanGeneGoStandardConnects
 * @property HumanMouseOrthology[] $humanMouseOrthologies
 * @property SuperGo[] $superGos
 * @property SuperGoConnect[] $superGoConnects
 * @property TranscriptionFactorConnection[] $transcriptionFactorConnections
 * @property DiseaseSubtype[] $diseases
 */
class HumanGene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'human_gene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entrez_id', 'gene_type_id', 'gene_symbol'], 'required'],
            [['entrez_id', 'gene_type_id', 'hpsd'], 'integer'],
            [['gene_description', 'gene_synonyms', 'human_gene_remark'], 'string'],
            [['sysid_id'], 'string', 'max' => 25],
            [['chromosome_location', 'gene_symbol', 'omim_id', 'ensembl_id', 'hprd_id', 'hgnc_id'], 'string', 'max' => 45],
            [['entrez_id'], 'unique'],
            [['gene_symbol'], 'unique'],
            [['sysid_id'], 'unique'],
            [['ensembl_id'], 'unique'],
            [['omim_id'], 'unique'],
            [['hgnc_id'], 'unique'],
            [['hprd_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_gene_id' => 'Human Gene Id',
            'entrez_id' => 'Entrez Id',
            'sysid_id' => 'SysID',
            'chromosome_location' => 'Chromosome Location',
            'gene_type_id' => 'Gene Type Id',
            'gene_symbol' => 'Gene Symbol',
            'gene_description' => 'Gene Description',
            'gene_synonyms' => 'Gene Synonyms',
            'omim_id' => 'Omim Id',
            'ensembl_id' => 'Ensembl Id',
            'hprd_id' => 'Hprd Id',
            'hgnc_id' => 'Hgnc Id',
            'hpsd' => 'Hpsd',
            'human_gene_remark' => 'Human Gene Remark',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneGroups()
    {
        return $this->hasMany(GeneGroup::className(), ['gene_group_id' => 'gene_group_id'])->via('geneGroupConnects');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneGroupConnects()
    {
        return $this->hasMany(GeneGroupConnect::className(), ['human_gene_id' => 'human_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanFlyOrthologyEnsembls()
    {
        return $this->hasMany(HumanFlyOrthologyEnsembl::className(), ['human_gene_id' => 'human_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanFlyOrthologyManuals()
    {
        return $this->hasMany(HumanFlyOrthologyManual::className(), ['human_gene_id' => 'human_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneType()
    {
        return $this->hasOne(GeneType::className(), ['gene_type_id' => 'gene_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneDiseaseConnects()
    {
        return $this->hasMany(HumanGeneDiseaseConnect::className(), ['human_gene_id' => 'human_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneGoStandardConnects()
    {
        return $this->hasMany(HumanGeneGoStandardConnect::className(), ['human_gene_id' => 'human_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanMouseOrthologies()
    {
        return $this->hasMany(HumanMouseOrthology::className(), ['human_gene_id' => 'human_gene_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperGos()
    {
        return $this->hasMany(SuperGo::className(), ['super_go_id' => 'super_go_id'])->via('superGoConnects');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperGoConnects()
    {
        return $this->hasMany(SuperGoConnect::className(), ['human_gene_id' => 'human_gene_id'])->andWhere(['super_go_connection_type' => 'M']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranscriptionFactorConnections()
    {
        return $this->hasMany(TranscriptionFactorConnection::className(), ['human_gene_id' => 'human_gene_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiseases()
    {
        return $this->hasMany(DiseaseSubtype::className(), ['disease_subtype_id' => 'disease_subtype_id'])->via('humanGeneDiseaseConnects');;
    }
    
    public static function getIdSymbolArray()
    {
        $hg = Yii::$app->db->createCommand("SELECT human_gene_id, gene_symbol FROM human_gene")->queryAll();
        $idSymbol=[];
        foreach ($hg as $value)
        {
            $idSymbol[$value['human_gene_id']]=$value['gene_symbol'];
        }
        
        return $idSymbol;
    }
}
