<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "gene_review".
 *
 * @property integer $gene_review_id
 * @property integer $gene_review
 * @property string $gene_review_remark
 *
 * @property GeneReviewConnect[] $geneReviewConnects
 */
class GeneReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gene_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gene_review'], 'required'],
            [['gene_review'], 'integer'],
            [['gene_review_remark'], 'string'],
            [['gene_review'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gene_review_id' => 'Gene Review ID',
            'gene_review' => 'Gene Review',
            'gene_review_remark' => 'Gene Review Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneReviewConnects()
    {
        return $this->hasMany(GeneReviewConnect::className(), ['gene_review_id' => 'gene_review_id']);
    }
    
    public static function getAllReviews()
    {
        $r = Yii::$app->db->createCommand("SELECT gene_review_id, gene_review FROM gene_review")->queryAll();
        $reviews=[];
        foreach ($r as $value)
        {
            $reviews[$value['gene_review']]=$value['gene_review_id'];
        }
        
        return $reviews;
    }
}
