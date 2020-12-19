<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "disease_subtype".
 *
 * @property integer $disease_subtype_id
 * @property string $disease_subtype
 * @property integer $disease_type_id
 * @property integer $omim_disease
 * @property integer $sysid_yes_no
 * @property string $disease_subtype_remark
 *
 * @property DiseaseType $diseaseType
 * @property HumanGeneDiseaseConnect[] $humanGeneDiseaseConnects
 */
class DiseaseSubtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disease_subtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disease_subtype', 'disease_type_id'], 'required'],
            [['disease_type_id', 'omim_disease', 'sysid_yes_no'], 'integer'],
            [['disease_subtype_remark'], 'string'],
            [['disease_subtype'], 'string', 'max' => 255],
            [['disease_subtype'], 'trim'],
            [['disease_subtype'], 'unique'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'disease_subtype_id' => 'Disease Subtype ID',
            'disease_subtype' => 'Disease Subtype',
            'disease_type_id' => 'Disease Type ID',
            'omim_disease' => 'Omim Disease',
            'sysid_yes_no' => 'Sysid Yes No',
            'disease_subtype_remark' => 'Disease Subtype Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiseaseType()
    {
        return $this->hasOne(DiseaseType::className(), ['disease_type_id' => 'disease_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneDiseaseConnects()
    {
        return $this->hasMany(HumanGeneDiseaseConnect::className(), ['disease_subtype_id' => 'disease_subtype_id']);
    }
}
