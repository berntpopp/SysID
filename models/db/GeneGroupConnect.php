<?php

namespace app\models\db;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "gene_group_connect".
 *
 * @property integer $gene_group_connect_id
 * @property integer $gene_group_id
 * @property integer $human_gene_id
 * @property string $date_of_entry
 * @property integer $entry_user_id
 * @property string $date_of_update
 * @property integer $update_user_id
 * @property string $human_gene_group_remark
 *
 * @property User $entryUser
 * @property User $updateUser
 * @property GeneGroup $geneGroup
 * @property HumanGene $humanGene
 */
class GeneGroupConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gene_group_connect';
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
            [['gene_group_id', 'human_gene_id', 'entry_user_id'], 'required'],
            [['gene_group_id', 'human_gene_id', 'entry_user_id', 'update_user_id'], 'integer'],
            [['date_of_entry', 'date_of_update'], 'safe'],
            [['human_gene_group_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gene_group_connect_id' => 'Gene Group Connect ID',
            'gene_group_id' => 'Gene Group ID',
            'human_gene_id' => 'Human Gene ID',
            'date_of_entry' => 'Date Of Entry',
            'entry_user_id' => 'Entry User ID',
            'date_of_update' => 'Date Of Update',
            'update_user_id' => 'Update User ID',
            'human_gene_group_remark' => 'Human Gene Group Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'entry_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'update_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneGroup()
    {
        return $this->hasOne(GeneGroup::className(), ['gene_group_id' => 'gene_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHumanGene()
    {
        return $this->hasOne(HumanGene::className(), ['human_gene_id' => 'human_gene_id']);
    }
}
