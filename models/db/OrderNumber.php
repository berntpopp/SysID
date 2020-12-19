<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "order_number".
 *
 * @property integer $order_number_id
 * @property string $order_number
 * @property integer $order_number_source_id
 * @property string $order_number_svalue
 * @property string $order_number_remark
 *
 * @property OrderNumberSource $orderNumberSource
 * @property Stock[] $stocks
 */
class OrderNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'order_number_source_id', 'order_number_svalue'], 'required'],
            [['order_number_source_id'], 'integer'],
            [['order_number_svalue'], 'number'],
            [['order_number_remark'], 'string'],
            [['order_number'], 'string', 'max' => 45],
            [['order_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_number_id' => 'Order Number ID',
            'order_number' => 'Order Number',
            'order_number_source_id' => 'Order Number Source ID',
            'order_number_svalue' => 'Order Number Svalue',
            'order_number_remark' => 'Order Number Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNumberSource()
    {        
        return $this->hasOne(OrderNumberSource::className(), ['order_number_source_id' => 'order_number_source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['order_number_id' => 'order_number_id']);
    }
}
