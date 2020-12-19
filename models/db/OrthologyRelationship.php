<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "orthology_relationship".
 *
 * @property integer $orthology_relationship_id
 * @property string $orthology_relationship
 * @property string $orthology_relationship_remark
 *
 * @property HumanFlyOrthologyManual[] $humanFlyOrthologyManuals
 */
class OrthologyRelationship extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orthology_relationship';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orthology_relationship'], 'required'],
            [['orthology_relationship_remark'], 'string'],
            [['orthology_relationship'], 'string', 'max' => 45],
            [['orthology_relationship'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orthology_relationship_id' => 'Orthology Relationship ID',
            'orthology_relationship' => 'Orthology Relationship',
            'orthology_relationship_remark' => 'Orthology Relationship Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanFlyOrthologyManuals()
    {
        return $this->hasMany(HumanFlyOrthologyManual::className(), ['orthology_relationship_id' => 'orthology_relationship_id']);
    }
}
