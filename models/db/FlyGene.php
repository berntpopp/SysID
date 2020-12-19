<?php

namespace app\models\db;

use app\models\db\CGNumberConnect;
use app\models\db\CGNumber;
use app\models\db\HumanFlyOrthologyEnsembl;
use app\models\db\HumanFlyOrthologyManual;
use app\models\db\Stock;

use Yii;

/**
 * This is the model class for table "fly_gene".
 *
 * @property integer $fly_gene_id
 * @property string $flybase_id
 * @property string $gene_name
 * @property string $gene_symbol
 * @property string $gene_synonyms
 * @property string $secondary_flybase_ids
 * @property string $fly_gene_remark
 *
 * @property CgNumberConnect[] $cgNumberConnects
 * @property CgNumber[] $cgNumbers
 * @property FlyGeneGoStandardConnect[] $flyGeneGoStandardConnects
 * @property HumanFlyOrthologyEnsembl[] $humanFlyOrthologyEnsembls
 * @property HumanFlyOrthologyManual[] $humanFlyOrthologyManuals
 * @property Stock[] $stocks
 */
class FlyGene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fly_gene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flybase_id'], 'required'],
            [['gene_synonyms', 'secondary_flybase_ids', 'fly_gene_remark'], 'string'],
            [['flybase_id'], 'string', 'max' => 11],
            [['gene_name'], 'string', 'max' => 255],
            [['gene_symbol'], 'string', 'max' => 45],
            [['flybase_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fly_gene_id' => 'Fly Gene ID',
            'flybase_id' => 'Flybase ID',
            'gene_name' => 'Gene Name',
            'gene_symbol' => 'Gene Symbol',
            'gene_synonyms' => 'Gene Synonyms',
            'secondary_flybase_ids' => 'Secondary Flybase Ids',
            'fly_gene_remark' => 'Fly Gene Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCgNumberConnects()
    {
        return $this->hasMany(CgNumberConnect::className(), ['fly_gene_id' => 'fly_gene_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCgNumbers()
    {
        return $this->hasMany(CGNumber::className(), ['cg_number_id' => 'cg_number_id'])->via('cgNumberConnects');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlyGeneGoStandardConnects()
    {
        return $this->hasMany(FlyGeneGoStandardConnect::className(), ['fly_gene_id' => 'fly_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanFlyOrthologyEnsembls()
    {
        return $this->hasMany(HumanFlyOrthologyEnsembl::className(), ['fly_gene_id' => 'fly_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanFlyOrthologyManuals()
    {
        return $this->hasMany(HumanFlyOrthologyManual::className(), ['fly_gene_id' => 'fly_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['fly_gene_id' => 'fly_gene_id']);
    }    
}
