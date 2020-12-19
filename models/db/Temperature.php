<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "temperature".
 *
 * @property integer $temperature_id
 * @property integer $temperature
 * @property string $temperature_remark
 *
 * @property Cross[] $crosses
 */
class Temperature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temperature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['temperature_id', 'temperature'], 'required'],
            [['temperature_id', 'temperature'], 'integer'],
            [['temperature_remark'], 'string'],
            [['temperature'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'temperature_id' => 'Temperature ID',
            'temperature' => 'Temperature',
            'temperature_remark' => 'Temperature Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrosses()
    {
        return $this->hasMany(Cross::className(), ['temperature_id' => 'temperature_id']);
    }
}
