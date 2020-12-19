<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "inheritance_type".
 *
 * @property integer $inheritance_type_id
 * @property string $inheritance_type
 * @property string $inheritance_type_remark
 *
 * @property HumanGeneDiseaseConnect[] $humanGeneDiseaseConnects
 */
class InheritanceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inheritance_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inheritance_type'], 'required'],
            [['inheritance_type_remark'], 'string'],
            [['inheritance_type'], 'string', 'max' => 25],
            [['inheritance_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inheritance_type_id' => 'Inheritance Type ID',
            'inheritance_type' => 'Inheritance Type',
            'inheritance_type_remark' => 'Inheritance Type Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneDiseaseConnects()
    {
        return $this->hasMany(HumanGeneDiseaseConnect::className(), ['inheritance_type_id' => 'inheritance_type_id']);
    }
}
