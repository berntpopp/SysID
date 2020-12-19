<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "human_gene_go_standard_connect".
 *
 * @property integer $human_gene_go_std_connect_id
 * @property integer $human_gene_id
 * @property integer $go_std_id
 * @property string $remark
 *
 * @property GoStandard $goStd
 * @property HumanGene $humanGene
 */
class HumanGeneGoStandardConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'human_gene_go_standard_connect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_id', 'go_std_id'], 'required'],
            [['human_gene_id', 'go_std_id'], 'integer'],
            [['remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_gene_go_std_connect_id' => 'Human Gene Go Std Connect ID',
            'human_gene_id' => 'Human Gene ID',
            'go_std_id' => 'Go Std ID',
            'remark' => 'Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoStd()
    {
        return $this->hasOne(GoStandard::className(), ['go_std_id' => 'go_std_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGene()
    {
        return $this->hasOne(HumanGene::className(), ['human_gene_id' => 'human_gene_id']);
    }
}
