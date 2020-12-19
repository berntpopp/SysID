<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "fly_gene".
 *
 * @property integer $fly_gene_id
 * @property string $flybase_id
 * @property string $gene_name
 * @property string $gene_symbol
 * @property string $gene_synonyms
 * @property string $secondary_flybase_ids
 * @property string $fly_gene_remark
 * @property string $cg_number
 * @property string $stock_id
 */
class HFlyGene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'h_fly_gene';
    }
    
    public static function primaryKey()
    {
        return ['fly_gene_id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flybase_id'], 'required'],
            [['gene_synonyms', 'secondary_flybase_ids', 'fly_gene_remark', 'cg_number'], 'string'],
            [['flybase_id'], 'string', 'max' => 11],
            [['gene_name'], 'string', 'max' => 255],
            [['gene_symbol'], 'string', 'max' => 45],
            [['stock_id'], 'integer'],
            [['flybase_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fly_gene_id' => 'Fly Gene ID',
            'flybase_id' => 'Flybase ID',
            'gene_name' => 'Gene Name',
            'gene_symbol' => 'Gene Symbol',
            'gene_synonyms' => 'Gene Synonyms',
            'secondary_flybase_ids' => 'Secondary Flybase Ids',
            'fly_gene_remark' => 'Fly Gene Remark',
            'cg_number' => 'CG Number',
            'stock_id' => 'Stock Id',
        ];
    }
}
