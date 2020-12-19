<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "inheritance_pattern".
 *
 * @property integer $inheritance_pattern_id
 * @property string $inheritance_pattern
 * @property string $inheritance_pattern_remark
 *
 * @property HumanGeneDiseaseConnect[] $humanGeneDiseaseConnects
 */
class InheritancePattern extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inheritance_pattern';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inheritance_pattern_id', 'inheritance_pattern'], 'required'],
            [['inheritance_pattern_id'], 'integer'],
            [['inheritance_pattern_remark'], 'string'],
            [['inheritance_pattern'], 'string', 'max' => 45],
            [['inheritance_pattern'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inheritance_pattern_id' => 'Inheritance Pattern ID',
            'inheritance_pattern' => 'Inheritance Pattern',
            'inheritance_pattern_remark' => 'Inheritance Pattern Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneDiseaseConnects()
    {
        return $this->hasMany(HumanGeneDiseaseConnect::className(), ['inheritance_pattern_id' => 'inheritance_pattern_id']);
    }
}
