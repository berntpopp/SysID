<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "additional_class".
 *
 * @property integer $additional_class_id
 * @property string $additional_class_type
 * @property string $additional_class_description
 * @property string $additional_class_remark
 *
 * @property AdditionalClassConnect[] $additionalClassConnects
 */
class AdditionalClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'additional_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['additional_class_type', 'additional_class_description'], 'required'],
            [['additional_class_description', 'additional_class_remark'], 'string'],
            [['additional_class_type'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'additional_class_id' => 'Additional Class ID',
            'additional_class_type' => 'Additional Class Type',
            'additional_class_description' => 'Additional Class Description',
            'additional_class_remark' => 'Additional Class Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalClassConnects()
    {
        return $this->hasMany(AdditionalClassConnect::className(), ['additional_class_id' => 'additional_class_id']);
    }
}
