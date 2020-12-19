<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "h_human_gene".
 *
 * @property integer $human_gene_id
 * @property integer $entrez_id
 * @property string $sysid_id
 * @property string $chromosome_location
 * @property string $gene_type
 * @property string $gene_symbol
 * @property string $gene_group
 * @property string $gene_description
 * @property string $gene_synonyms
 * @property string $omim_id
 * @property string $ensembl_id
 * @property string $hprd_id
 * @property string $hgnc_id
 * @property integer $hpsd
 * @property string $human_gene_remark
 * @property string $super_go
 */
class HHumanGene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'h_human_gene';
    }
    
    public static function primaryKey()
    {
        return ['human_gene_id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_id', 'entrez_id', 'hpsd'], 'integer'],
            [['entrez_id', 'gene_symbol'], 'required'],
            [['gene_group', 'gene_description', 'gene_synonyms', 'human_gene_remark', 'super_go'], 'string'],
            [['sysid_id'], 'string', 'max' => 25],
            [['chromosome_location', 'gene_type', 'gene_symbol', 'omim_id', 'ensembl_id', 'hprd_id', 'hgnc_id'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_gene_id' => 'Human Gene Id',
            'entrez_id' => 'Entrez Id',
            'sysid_id' => 'SysID',
            'chromosome_location' => 'Chromosome Location',
            'gene_type' => 'Gene Type',
            'gene_symbol' => 'Gene Symbol',
            'gene_group' => 'Gene Group',
            'gene_description' => 'Gene Description',
            'gene_synonyms' => 'Gene Synonyms',
            'omim_id' => 'Omim Id',
            'ensembl_id' => 'Ensembl Id',
            'hprd_id' => 'Hprd Id',
            'hgnc_id' => 'Hgnc Id',
            'hpsd' => 'Hpsd',
            'human_gene_remark' => 'Human Gene Remark',
            'super_go' => 'Super Go',
        ];
    }
}
