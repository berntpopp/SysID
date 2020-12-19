<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "cross".
 *
 * @property integer $cross_id
 * @property integer $stock_id
 * @property integer $driver_stock_id
 * @property integer $sex_id
 * @property integer $temperature_id
 * @property string $cross_remark
 *
 * @property Sex $sex
 * @property Temperature $temperature
 * @property Stock $stock
 * @property ExperimentEyeScreen[] $experimentEyeScreens
 * @property ExperimentGlialFlightPerformance[] $experimentGlialFlightPerformances
 * @property ExperimentNeuronalFlightPerformance[] $experimentNeuronalFlightPerformances
 * @property ExperimentWing[] $experimentWings
 * @property Lethality[] $lethalities
 */
class Cross extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cross';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_id', 'driver_stock_id', 'sex_id', 'temperature_id'], 'required'],
            [['stock_id', 'driver_stock_id', 'sex_id', 'temperature_id'], 'integer'],
            [['cross_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cross_id' => 'Cross Id',
            'stock_id' => 'Stock Id',
            'driver_stock_id' => 'Driver Stock Id',
            'sex_id' => 'Sex Id',
            'temperature_id' => 'Temperature',
            'cross_remark' => 'Cross Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSex()
    {
        return $this->hasOne(Sex::className(), ['sex_id' => 'sex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemperature()
    {
        return $this->hasOne(Temperature::className(), ['temperature_id' => 'temperature_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['stock_id' => 'stock_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentEyeScreens()
    {
        return $this->hasMany(ExperimentEyeScreen::className(), ['cross_id' => 'cross_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentGlialFlightPerformances()
    {
        return $this->hasMany(ExperimentGlialFlightPerformance::className(), ['cross_id' => 'cross_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentNeuronalFlightPerformances()
    {
        return $this->hasMany(ExperimentNeuronalFlightPerformance::className(), ['cross_id' => 'cross_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentWings()
    {
        return $this->hasMany(ExperimentWing::className(), ['cross_id' => 'cross_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLethalities()
    {
        return $this->hasMany(Lethality::className(), ['cross_id' => 'cross_id']);
    }
}
