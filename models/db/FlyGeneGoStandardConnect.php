<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "fly_gene_go_standard_connect".
 *
 * @property integer $fly_gene_go_std_connect_id
 * @property integer $fly_gene_id
 * @property integer $go_std_id
 * @property string $remark
 *
 * @property FlyGene $flyGene
 * @property GoStandard $goStd
 */
class FlyGeneGoStandardConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fly_gene_go_standard_connect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fly_gene_id', 'go_std_id'], 'required'],
            [['fly_gene_id', 'go_std_id'], 'integer'],
            [['remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fly_gene_go_std_connect_id' => 'Fly Gene Go Standard Connect ID',
            'fly_gene_id' => 'Fly Gene ID',
            'go_std_id' => 'Go Std ID',
            'remark' => 'Remark',
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
    public function getGoStd()
    {
        return $this->hasOne(GoStandard::className(), ['go_std_id' => 'go_std_id']);
    }
}
