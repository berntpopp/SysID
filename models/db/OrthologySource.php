<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "orthology_source".
 *
 * @property integer $orthology_source_id
 * @property string $orthology_source
 * @property string $orthology_source_remark
 *
 * @property HumanFlyOrthologyManual[] $humanFlyOrthologyManuals
 */
class OrthologySource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orthology_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orthology_source'], 'required'],
            [['orthology_source_remark'], 'string'],
            [['orthology_source'], 'string', 'max' => 45],
            [['orthology_source'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orthology_source_id' => 'Orthology Source ID',
            'orthology_source' => 'Orthology Source',
            'orthology_source_remark' => 'Orthology Source Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanFlyOrthologyManuals()
    {
        return $this->hasMany(HumanFlyOrthologyManual::className(), ['orthology_source_id' => 'orthology_source_id']);
    }
}
