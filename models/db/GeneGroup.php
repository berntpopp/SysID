<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "gene_group".
 *
 * @property integer $gene_group_id
 * @property string $gene_group
 * @property string $gene_group_remark
 *
 * @property GeneGroupConnect[] $geneGroupConnects
 */
class GeneGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gene_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gene_group'], 'required'],
            [['gene_group_remark'], 'string'],
            [['gene_group'], 'string', 'max' => 45],
            [['gene_group'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gene_group_id' => 'Gene Group ID',
            'gene_group' => 'Gene Group',
            'gene_group_remark' => 'Gene Group Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneGroupConnects()
    {
        return $this->hasMany(GeneGroupConnect::className(), ['gene_group_id' => 'gene_group_id']);
    }
}
