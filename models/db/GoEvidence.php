<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "go_evidence".
 *
 * @property integer $go_evidence_id
 * @property string $go_evidence
 * @property string $go_evidence_remark
 *
 * @property FlyGeneGoStandardConnect[] $flyGeneGoStandardConnects
 * @property HumanGeneGoStandardConnect[] $humanGeneGoStandardConnects
 */
class GoEvidence extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'go_evidence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['go_evidence'], 'required'],
            [['go_evidence_remark'], 'string'],
            [['go_evidence'], 'string', 'max' => 10],
            [['go_evidence'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'go_evidence_id' => 'Go Evidence ID',
            'go_evidence' => 'Go Evidence',
            'go_evidence_remark' => 'Go Evidence Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlyGeneGoStandardConnects()
    {
        return $this->hasMany(FlyGeneGoStandardConnect::className(), ['go_evidence_id' => 'go_evidence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneGoStandardConnects()
    {
        return $this->hasMany(HumanGeneGoStandardConnect::className(), ['go_evidence_id' => 'go_evidence_id']);
    }
}
