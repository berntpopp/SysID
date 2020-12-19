<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "super_go".
 *
 * @property integer $super_go_id
 * @property string $super_go
 * @property string $super_go_remark
 *
 * @property SuperGoConnect[] $superGoConnects
 */
class SuperGo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_go';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['super_go'], 'required'],
            [['super_go_remark'], 'string'],
            [['super_go'], 'string', 'max' => 45],
            [['super_go'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'super_go_id' => 'Super Go ID',
            'super_go' => 'Super Go',
            'super_go_remark' => 'Super Go Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperGoConnects()
    {
        return $this->hasMany(SuperGoConnect::className(), ['super_go_id' => 'super_go_id']);
    }
}
