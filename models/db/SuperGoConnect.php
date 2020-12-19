<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "super_go_connect".
 *
 * @property integer $super_go_connect_id
 * @property integer $human_gene_id
 * @property integer $super_go_id
 * @property string $super_go_connection_type
 *
 * @property HumanGene $humanGene
 * @property SuperGo $superGo
 */
class SuperGoConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_go_connect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_id', 'super_go_id'], 'required'],
            [['human_gene_id', 'super_go_id'], 'integer'],
            [['super_go_connection_type'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'super_go_connect_id' => 'Super Go Connect ID',
            'human_gene_id' => 'Human Gene ID',
            'super_go_id' => 'Super Go ID',
            'super_go_connection_type' => 'Super Go Connection Type',
        ];
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
    public function getSuperGo()
    {
        return $this->hasOne(SuperGo::className(), ['super_go_id' => 'super_go_id']);
    }
}
