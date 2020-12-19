<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "cg_number_connect".
 *
 * @property integer $cg_number_connect_id
 * @property integer $fly_gene_id
 * @property integer $cg_number_id
 * @property string $cg_connect_remark
 *
 * @property CgNumber $cgNumber
 * @property FlyGene $flyGene
 */
class CGNumberConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cg_number_connect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fly_gene_id', 'cg_number_id'], 'required'],
            [['fly_gene_id', 'cg_number_id'], 'integer'],            
            [['cg_connect_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cg_number_connect_id' => 'CG Number Connect Id',
            'fly_gene_id' => 'Fly Gene Id',
            'cg_number_id' => 'CG Number Id',            
            'cg_connect_remark' => 'CG Number Connect Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCgNumber()
    {
        return $this->hasOne(CgNumber::className(), ['cg_number_id' => 'cg_number_id']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlyGene()
    {
        return $this->hasOne(FlyGene::className(), ['fly_gene_id' => 'fly_gene_id']);
    }
}
