<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "sex".
 *
 * @property integer $sex_id
 * @property string $sex
 * @property string $sex_remark
 *
 * @property Cross[] $crosses
 * @property ExperimentEyeScreen[] $experimentEyeScreens
 * @property ExperimentGlialFlightPerformance[] $experimentGlialFlightPerformances
 * @property ExperimentNeuronalFlightPerformance[] $experimentNeuronalFlightPerformances
 * @property ExperimentWing[] $experimentWings
 */
class Sex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex_id', 'sex'], 'required'],
            [['sex_id'], 'integer'],
            [['sex_remark'], 'string'],
            [['sex'], 'string', 'max' => 45],
            [['sex'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sex_id' => 'Sex ID',
            'sex' => 'Sex',
            'sex_remark' => 'Sex Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrosses()
    {
        return $this->hasMany(Cross::className(), ['sex_id' => 'sex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentEyeScreens()
    {
        return $this->hasMany(ExperimentEyeScreen::className(), ['sex_id' => 'sex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentGlialFlightPerformances()
    {
        return $this->hasMany(ExperimentGlialFlightPerformance::className(), ['sex_id' => 'sex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentNeuronalFlightPerformances()
    {
        return $this->hasMany(ExperimentNeuronalFlightPerformance::className(), ['sex_id' => 'sex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperimentWings()
    {
        return $this->hasMany(ExperimentWing::className(), ['sex_id' => 'sex_id']);
    }
}
