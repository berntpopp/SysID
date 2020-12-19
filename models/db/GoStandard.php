<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "go_standard".
 *
 * @property integer $go_std_id
 * @property string $go_id
 * @property string $go_term
 * @property integer $go_category_id
 * @property string $go_remark
 * @property integer $go_evidence_id
 * @property integer $go_reference
 *
 * @property FlyGeneGoStandardConnect[] $flyGeneGoStandardConnects
 * @property GoCategory $goCategory
 * @property GoEvidence $goEvidence
 * @property HumanGeneGoStandardConnect[] $humanGeneGoStandardConnects
 */
class GoStandard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'go_standard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['go_id', 'go_term'], 'required'],
            [['go_term', 'go_remark'], 'string'],
            [['go_category_id', 'go_evidence_id', 'go_reference'], 'integer'],
            [['go_id'], 'string', 'max' => 45],
            [['go_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'go_std_id' => 'Go Std ID',
            'go_id' => 'Go ID',
            'go_term' => 'Go Term',
            'go_category_id' => 'Go Category ID',
            'go_remark' => 'Go Remark',
            'go_evidence_id' => 'Go Evidence ID',
            'go_reference' => 'Go Reference',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlyGeneGoStandardConnects()
    {
        return $this->hasMany(FlyGeneGoStandardConnect::className(), ['go_std_id' => 'go_std_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoCategory()
    {
        return $this->hasOne(GoCategory::className(), ['go_category_id' => 'go_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoEvidence()
    {
        return $this->hasOne(GoEvidence::className(), ['go_evidence_id' => 'go_evidence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneGoStandardConnects()
    {
        return $this->hasMany(HumanGeneGoStandardConnect::className(), ['go_std_id' => 'go_std_id']);
    }
}
