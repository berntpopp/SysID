<?php

namespace app\models\db;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\models\user\User;

use Yii;

/**
 * This is the model class for table "human_fly_orthology_manual".
 *
 * @property integer $human_fly_orthology_manual_id
 * @property integer $human_gene_id
 * @property integer $fly_gene_id
 * @property integer $orthology_relationship_id
 * @property integer $orthology_source_id
 * @property integer $to_be_investigated_2013
 * @property string $date_of_entry
 * @property integer $entry_user_id
 * @property string $date_of_update
 * @property integer $update_user_id
 * @property string $human_fly_manual_remark
 *
 * @property User $entryUser
 * @property User $updateUser
 * @property FlyGene $flyGene
 * @property HumanGene $humanGene
 * @property OrthologyRelationship $orthologyRelationship
 * @property OrthologySource $orthologySource
 */
class HumanFlyOrthologyManual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'human_fly_orthology_manual';
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
            [['human_gene_id', 'fly_gene_id', 'orthology_relationship_id', 'orthology_source_id', 'entry_user_id'], 'required'],
            [['human_gene_id', 'fly_gene_id', 'orthology_relationship_id', 'orthology_source_id', 'to_be_investigated_2013', 'entry_user_id', 'update_user_id'], 'integer'],
            [['date_of_entry', 'date_of_update'], 'safe'],
            [['human_fly_manual_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'human_fly_orthology_manual_id' => 'Human Fly Orthology Manual ID',
            'human_gene_id' => 'Human Gene ID',
            'fly_gene_id' => 'Fly Gene ID',
            'orthology_relationship_id' => 'Orthology Relationship ID',
            'orthology_source_id' => 'Orthology Source ID',
            'to_be_investigated_2013' => 'To Be Investigated 2013',
            'date_of_entry' => 'Date Of Entry',
            'entry_user_id' => 'Entry User ID',
            'date_of_update' => 'Date Of Update',
            'update_user_id' => 'Update User ID',
            'human_fly_manual_remark' => 'Human Fly Manual Remark',
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
    public function getFlyGene()
    {
        return $this->hasOne(FlyGene::className(), ['fly_gene_id' => 'fly_gene_id']);
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
    public function getOrthologyRelationship()
    {
        return $this->hasOne(OrthologyRelationship::className(), ['orthology_relationship_id' => 'orthology_relationship_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrthologySource()
    {
        return $this->hasOne(OrthologySource::className(), ['orthology_source_id' => 'orthology_source_id']);
    }
}
