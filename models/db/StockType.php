<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "stock_type".
 *
 * @property integer $stock_type_id
 * @property string $stock_type
 * @property string $stock_type_remark
 *
 * @property Stock[] $stocks
 */
class StockType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_type'], 'required'],
            [['stock_type_remark'], 'string'],
            [['stock_type'], 'string', 'max' => 45],
            [['stock_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stock_type_id' => 'Stock Type ID',
            'stock_type' => 'Stock Type',
            'stock_type_remark' => 'Stock Type Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['stock_type_id' => 'stock_type_id']);
    }
}
