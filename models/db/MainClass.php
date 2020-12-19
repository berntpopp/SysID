<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "main_class".
 *
 * @property integer $main_class_id
 * @property string $main_class_type
 * @property string $main_class_description
 * @property string $main_class_remark
 *
 * @property MainClassConnect[] $mainClassConnects
 */
class MainClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_class_type', 'main_class_description'], 'required'],
            [['main_class_remark'], 'string'],
            [['main_class_type'], 'string', 'max' => 45],
            [['main_class_description'], 'string', 'max' => 255],
            [['main_class_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'main_class_id' => 'Main Class ID',
            'main_class_type' => 'Main Class Type',
            'main_class_description' => 'Main Class Description',
            'main_class_remark' => 'Main Class Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainClassConnects()
    {
        return $this->hasMany(MainClassConnect::className(), ['main_class_id' => 'main_class_id']);
    }
}
