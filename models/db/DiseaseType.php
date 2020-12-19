<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "disease_type".
 *
 * @property integer $disease_type_id
 * @property string $disease_type
 * @property string $disease_type_remark
 *
 * @property DiseaseSubtype[] $diseaseSubtypes
 */
class DiseaseType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disease_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disease_type'], 'required'],
            [['disease_type_remark'], 'string'],
            [['disease_type'], 'string', 'max' => 255],
            [['disease_type'], 'trim'],
            [['disease_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'disease_type_id' => 'Disease Type ID',
            'disease_type' => 'Disease Type',
            'disease_type_remark' => 'Disease Type Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiseaseSubtypes()
    {
        return $this->hasMany(DiseaseSubtype::className(), ['disease_type_id' => 'disease_type_id']);
    }
}
