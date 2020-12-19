<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "human_fly_orthology_ensembl".
 *
 * @property integer $human_fly_orthology_ensembl_id
 * @property integer $human_gene_id
 * @property integer $fly_gene_id
 * @property string $orthology_relationship 
 * @property string $human_fly_ensembl_remark
 *
 * @property FlyGene $flyGene
 * @property HumanGene $humanGene
 */
class HumanFlyOrthologyEnsembl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'human_fly_orthology_ensembl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_id', 'fly_gene_id'], 'required'],
            [['human_gene_id', 'fly_gene_id'], 'integer'],
            [['human_fly_ensembl_remark'], 'string'],
            [['orthology_relationship'], 'string', 'max' => 75]            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_fly_orthology_ensembl_id' => 'Human Fly Orthology Ensembl ID',
            'human_gene_id' => 'Human Gene ID',
            'fly_gene_id' => 'Fly Gene ID',
            'orthology_relationship' => 'Orthology Relationship',            
            'human_fly_ensembl_remark' => 'Human Fly Ensembl Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlyGene()
    {
        return $this->hasOne(FlyGene::className(), ['fly_gene_id' => 'fly_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGene()
    {
        return $this->hasOne(HumanGene::className(), ['human_gene_id' => 'human_gene_id']);
    }
}
