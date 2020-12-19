<?php

namespace app\models\db;

use app\models\user\User;

use Yii;

/**
 * This is the model class for table "h_disease_info".
 *
 * @property integer $human_gene_disease_id
 * @property string $gene_symbol
 * @property string $inheritance_pattern
 * @property string $inheritance_type
 * @property string $main_class
 * @property string $accompanying_phenotype
 * @property integer $limited_confidence_criterion
 * @property integer $sysid_yes_no
 * @property string $disease_subtype
 * @property string $disease_type
 * @property string $disease_subtype_id
 * @property string $disease_type_id
 * @property string $alternative_names
 * @property string $additional_references
 * @property integer $omim_disease
 * @property string $disease_subtype_remark
 * @property string $gene_review
 * @property integer $haploinsufficiency_yes_no
 * @property string $clinical_synopsis
 * @property string $entry_user_id
 * @property string $date_of_entry
 * @property string $update_user_id
 * @property string $date_of_update
 * @property User $updateUser
 * @property User $entryUser
 */
class HHumanGeneDiseaseConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'h_disease_info';
    }
    
    public static function primaryKey()
    {
        return ['human_gene_disease_id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_disease_id', 'human_gene_id', 'limited_confidence_criterion', 'sysid_yes_no', 'omim_disease', 'haploinsufficiency_yes_no', 'disease_subtype_id', 'disease_type_id'], 'integer'],
            [['main_class', 'accompanying_phenotype', 'alternative_names', 'additional_references', 'disease_subtype_remark', 'gene_review', 'clinical_synopsis', 'human_gene_disease_remark'], 'string'],
            [['gene_symbol', 'inheritance_pattern'], 'string', 'max' => 45],
            [['inheritance_type'], 'string', 'max' => 25],
            [['disease_subtype', 'disease_type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_gene_disease_id' => 'Human Gene Disease Id',
            'gene_symbol' => 'Gene Symbol',
            'inheritance_pattern' => 'Inheritance Pattern',
            'inheritance_type' => 'Inheritance Type',
            'main_class' => 'Main Class',
            'accompanying_phenotype' => 'Accompanying Phenotype',
            'limited_confidence_criterion' => 'Limited Confidence Criterion',
            'sysid_yes_no' => 'Sysid Yes No',
            'disease_subtype' => 'Disease Subtype',
            'disease_type' => 'Disease Type',
            'alternative_names' => 'Alternative Names',
            'additional_references' => 'Additional References',
            'omim_disease' => 'Omim Disease',
            'disease_subtype_remark' => 'Disease Subtype Remark',
            'gene_review' => 'Gene Review',
            'haploinsufficiency_yes_no' => 'Haploinsufficiency Yes No',
            'clinical_synopsis' => 'Clinical Synopsis',
            'human_gene_disease_remark' => 'Human Gene Disease Remark',
        ];
    }
    
    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'update_user_id']);
    }
    
    public function getEntryUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'entry_user_id']);
    }
}
