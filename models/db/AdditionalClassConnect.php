<?php

namespace app\models\db;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "additional_class_connect".
 *
 * @property integer $additional_class_connect_id
 * @property integer $human_gene_disease_id
 * @property integer $additional_class_id
 * @property integer $confidence_criteria_limit_clinical_desc
 * @property string $date_of_entry
 * @property integer $entry_user_id
 * @property string $date_of_update
 * @property integer $update_user_id
 * @property string $additional_class_remark
 *
 * @property AdditionalClass $additionalClass
 * @property HumanGeneDiseaseConnect $humanGeneDisease
 */
class AdditionalClassConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'additional_class_connect';
    }
    
    public function behaviors()
    {
        return [
            //TimestampBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_of_entry',
                'updatedAtAttribute' => 'date_of_update',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_disease_id', 'additional_class_id', 'confidence_criteria_limit_clinical_desc', 'entry_user_id'], 'required'],
            [['human_gene_disease_id', 'additional_class_id', 'confidence_criteria_limit_clinical_desc', 'entry_user_id', 'update_user_id'], 'integer'],
            [['date_of_entry', 'date_of_update'], 'safe'],
            [['additional_class_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'additional_class_connect_id' => 'Additional Class Connect ID',
            'human_gene_disease_id' => 'Human Gene Disease ID',
            'additional_class_id' => 'Additional Class ID',
            'confidence_criteria_limit_clinical_desc' => 'Confidence Criteria Limit Clinical Desc',
            'date_of_entry' => 'Date Of Entry',
            'entry_user_id' => 'Entry User ID',
            'date_of_update' => 'Date Of Update',
            'update_user_id' => 'Update User ID',
            'additional_class_remark' => 'Additional Class Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalClass()
    {
        return $this->hasOne(AdditionalClass::className(), ['additional_class_id' => 'additional_class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneDisease()
    {
        return $this->hasOne(HumanGeneDiseaseConnect::className(), ['human_gene_disease_id' => 'human_gene_disease_id']);
    }
}
