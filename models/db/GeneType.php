<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "gene_type".
 *
 * @property integer $gene_type_id
 * @property string $gene_type
 * @property string $gene_type_remark
 */
class GeneType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gene_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gene_type'], 'required'],
            [['gene_type_remark'], 'string'],
            [['gene_type'], 'string', 'max' => 45],
            [['gene_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gene_type_id' => 'Gene Type ID',
            'gene_type' => 'Gene Type',
            'gene_type_remark' => 'Gene Type Remark',
        ];
    }
    
    public static function getGeneTypes()
    {
        
    }
}
