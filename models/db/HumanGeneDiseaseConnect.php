<?php

namespace app\models\db;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "human_gene_disease_connect".
 *
 * @property integer $human_gene_disease_id
 * @property integer $human_gene_id
 * @property integer $disease_subtype_id
 * @property integer $inheritance_pattern_id
 * @property integer $inheritance_type_id
 * @property integer $haploinsufficiency_yes_no
 * @property integer $confidence_criteria_limit_no_patient
 * @property string $alternative_names
 * @property string $additional_references
 * @property string $clinical_synopsis
 * @property string $date_of_entry
 * @property integer $entry_user_id
 * @property string $date_of_update
 * @property integer $update_user_id
 * @property string $human_gene_disease_remark
 *
 * @property AdditionalClassConnect[] $additionalClassConnects
 * @property AdditionalClass[] $additionalClasses
 * @property AdditionalClass[] $realAdditionalClasses
 * @property GeneReviewConnect[] $geneReviewConnects
 * @property GeneReview[] $geneReviews
 * @property DiseaseSubtype $diseaseSubtype
 * @property User $updateUser
 * @property User $entryUser
 * @property HumanGene $humanGene
 * @property InheritancePattern $inheritancePattern
 * @property InheritanceType $inheritanceType
 * @property MainClassConnect[] $mainClassConnects 
 * @property MainClass[] $mainClasses 
 */
class HumanGeneDiseaseConnect extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'human_gene_disease_connect';
    }

    /**
     * @inheritdoc
     */
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
            [['human_gene_id', 'disease_subtype_id', 'inheritance_pattern_id', 'inheritance_type_id', 'entry_user_id'], 'required'],
            [['human_gene_id', 'disease_subtype_id', 'inheritance_pattern_id', 'inheritance_type_id', 'haploinsufficiency_yes_no', 'confidence_criteria_limit_no_patient', 'entry_user_id', 'update_user_id'], 'integer'],
            [['alternative_names', 'additional_references', 'clinical_synopsis', 'human_gene_disease_remark'], 'string'],
            [['alternative_names', 'additional_references', 'clinical_synopsis', 'human_gene_disease_remark'], 'trim'],
            [['date_of_entry', 'date_of_update'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_gene_disease_id' => 'Human Gene Disease ID',
            'human_gene_id' => 'Human Gene ID',
            'disease_subtype_id' => 'Disease Subtype ID',
            'inheritance_pattern_id' => 'Inheritance Pattern ID',
            'inheritance_type_id' => 'Inheritance Type ID',
            'haploinsufficiency_yes_no' => 'Haploinsufficiency Yes No',
            'confidence_criteria_limit_no_patient' => 'Confidence Criteria Limit No Patient',
            'alternative_names' => 'Alternative Names',
            'additional_references' => 'Additional References',
            'clinical_synopsis' => 'Clinical Synopsis',
            'date_of_entry' => 'Date Of Entry',
            'entry_user_id' => 'Entry User ID',
            'date_of_update' => 'Date Of Update',
            'update_user_id' => 'Update User ID',
            'human_gene_disease_remark' => 'Human Gene Disease Remark',
        ];
    }

    public function getAllAdditionalClasses()
    {
        $ac = Yii::$app->db->createCommand('SELECT additional_class_id, additional_class_type FROM additional_class')->queryAll();
        $acAll = [];

        foreach ($ac as $value)
        {
            $acAll[$value['additional_class_id']] = $value['additional_class_type'];
            $acAll[100 + $value['additional_class_id']] = '(' . $value['additional_class_type'] . ')';
        }

        return $acAll;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalClassConnects()
    {
        return $this->hasMany(AdditionalClassConnect::className(), ['human_gene_disease_id' => 'human_gene_disease_id']);
    }

    public function getAdditionalClasses()
    {
        $acc = $this->additionalClassConnects;
        $ac = $this->hasMany(AdditionalClass::className(), ['additional_class_id' => 'additional_class_id'])->via('additionalClassConnects')->all();

        foreach ($acc as $value)
        {
            if ($value['confidence_criteria_limit_clinical_desc'] == 1)
            {
                for ($i = 0; $i < count($ac); $i++)
                {
                    if ($value['additional_class_id'] === $ac[$i]['additional_class_id'])
                    {
                        $ac[$i]['additional_class_id'] = $ac[$i]['additional_class_id'] + 100;
                    }
                }
            }
        }

        return $ac;
    }
    
    public function getRealAdditionalClasses()
    {       
        return $this->hasMany(AdditionalClass::className(), ['additional_class_id' => 'additional_class_id'])->via('additionalClassConnects');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneReviewConnects()
    {
        return $this->hasMany(GeneReviewConnect::className(), ['human_gene_disease_id' => 'human_gene_disease_id']);
    }
    
    public function getGeneReviews()
    {
        return $this->hasMany(GeneReview::className(), ['gene_review_id' => 'gene_review_id'])->via('geneReviewConnects');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiseaseSubtype()
    {
        return $this->hasOne(DiseaseSubtype::className(), ['disease_subtype_id' => 'disease_subtype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'update_user_id']);
    }
    
    public function getEntryUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'entry_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGene()
    {
        return $this->hasOne(HumanGene::className(), ['human_gene_id' => 'human_gene_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInheritancePattern()
    {
        return $this->hasOne(InheritancePattern::className(), ['inheritance_pattern_id' => 'inheritance_pattern_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInheritanceType()
    {
        return $this->hasOne(InheritanceType::className(), ['inheritance_type_id' => 'inheritance_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainClassConnects()
    {
        return $this->hasMany(MainClassConnect::className(), ['human_gene_disease_id' => 'human_gene_disease_id']);
    }

    public function getMainClasses()
    {
        return $this->hasMany(MainClass::className(), ['main_class_id' => 'main_class_id'])->via('mainClassConnects');
    }    

    public static function getDiseasesHierarchy2()
    {
        $options = [];
        $diseaseTypes = Yii::$app->db->createCommand("SELECT disease_type_id, disease_type FROM disease_type")->queryAll();
        foreach ($diseaseTypes as $value)
        {
            $subtypes = Yii::$app->db->createCommand('SELECT disease_subtype_id, disease_subtype FROM disease_subtype WHERE disease_type_id =' . $value['disease_type_id'])->queryAll();

            $options[$value['disease_type']] = $subtypes;
        }

        return $options;
    }

    public static function getDiseasesHierarchy()
    {
        $options = [];
        $data = Yii::$app->db->createCommand("SELECT ds.disease_subtype_id, ds.disease_subtype, ds.disease_type_id, dt.disease_type FROM disease_subtype ds JOIN disease_type dt ON ds.disease_type_id = dt.disease_type_id ORDER BY disease_type, disease_subtype;")->queryAll();

        $oldDtId = $data[0]['disease_type_id'];
        $oldDt = $data[0]['disease_type'];
        $subtypes = [];
        $subtypes[$data[0]['disease_subtype_id']] = $data[0]['disease_subtype'];
        for ($i = 1; $i < count($data); $i++)
        {
            if ($data[$i]['disease_type_id'] === $oldDtId)
            {
                $subtypes[$data[$i]['disease_subtype_id']] = $data[$i]['disease_subtype'];
            }
            else
            {
                $options[$oldDt] = $subtypes;
                $oldDtId = $data[$i]['disease_type_id'];
                $oldDt = $data[$i]['disease_type'];
                $subtypes = [];
                $subtypes[$data[$i]['disease_subtype_id']] = $data[$i]['disease_subtype'];
            }
        }
        $options[$oldDt] = $subtypes;
        return $options;
    }

}
