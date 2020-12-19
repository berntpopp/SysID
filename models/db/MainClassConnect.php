<?php

namespace app\models\db;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "main_class_connect".
 *
 * @property integer $main_class_connect_id
 * @property integer $human_gene_disease_id
 * @property integer $main_class_id
 * @property string $date_of_entry
 * @property integer $entry_user_id
 * @property string $date_of_update
 * @property integer $update_user_id
 * @property string $disease_remark
 *
 * @property User $entryUser
 * @property User $updateUser
 * @property HumanGeneDiseaseConnect $humanGeneDisease
 * @property MainClass $mainClass
 */
class MainClassConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_class_connect';
    }
    
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
            [['human_gene_disease_id', 'main_class_id', 'entry_user_id'], 'required'],
            [['human_gene_disease_id', 'main_class_id', 'entry_user_id', 'update_user_id'], 'integer'],
            [['date_of_entry', 'date_of_update'], 'safe'],
            [['disease_remark'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'main_class_connect_id' => 'Main Class Connect ID',
            'human_gene_disease_id' => 'Human Gene Disease ID',
            'main_class_id' => 'Main Class ID',
            'date_of_entry' => 'Date Of Entry',
            'entry_user_id' => 'Entry User ID',
            'date_of_update' => 'Date Of Update',
            'update_user_id' => 'Update User ID',
            'disease_remark' => 'Disease Remark',
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
    public function getHumanGeneDisease()
    {
        return $this->hasOne(HumanGeneDiseaseConnect::className(), ['human_gene_disease_id' => 'human_gene_disease_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainClass()
    {
        return $this->hasOne(MainClass::className(), ['main_class_id' => 'main_class_id']);
    }
}
