<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "gene_review_connect".
 *
 * @property integer $gene_review_connect_id
 * @property integer $human_gene_disease_id
 * @property integer $gene_review_id
 * @property string $gene_review_remark
 *
 * @property HumanGeneDiseaseConnect $humanGeneDisease
 * @property GeneReview $geneReview
 */
class GeneReviewConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gene_review_connect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_disease_id', 'gene_review_id'], 'required'],
            [['human_gene_disease_id', 'gene_review_id'], 'integer'],
            [['gene_review_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gene_review_connect_id' => 'Gene Review Connect ID',
            'human_gene_disease_id' => 'Human Gene Disease ID',
            'gene_review_id' => 'Gene Review ID',
            'gene_review_remark' => 'Gene Review Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGeneDisease()
    {
        return $this->hasOne(HumanGeneDiseaseConnect::className(), ['human_gene_disease_id' => 'human_gene_disease_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneReview()
    {
        return $this->hasOne(GeneReview::className(), ['gene_review_id' => 'gene_review_id']);
    }
}
