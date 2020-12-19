<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "cg_number".
 *
 * @property integer $cg_number_id
 * @property string $cg_number
 * @property string $cg_number_remark
 *
 * @property CgNumberConnect[] $cgNumberConnects
 */
class CGNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cg_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cg_number'], 'required'],
            [['cg_number_remark'], 'string'],
            [['cg_number'], 'string', 'max' => 10],
            [['cg_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cg_number_id' => 'Cg Number ID',
            'cg_number' => 'Cg Number',
            'cg_number_remark' => 'Cg Number Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCgNumberConnects()
    {
        return $this->hasMany(CgNumberConnect::className(), ['cg_number_id' => 'cg_number_id']);
    }
    
    public static function getAllCgNumbers()
    {
        return implode('","', \Yii::$app->db->createCommand("SELECT cg_number FROM cg_number")->queryColumn());
    }
    
    public static function getAllCgNumbersAndIds()
    {
        $r = Yii::$app->db->createCommand("SELECT cg_number_id, cg_number FROM cg_number")->queryAll();
        $result=[];
        foreach ($r as $value)
        {
            $result[$value['cg_number']]=$value['cg_number_id'];
        }
        
        return $result;
    }
}
