<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $stock_id
 * @property integer $stock_type_id
 * @property integer $order_number_id
 * @property integer $fly_gene_id
 * @property string $stock_remark
 *
 * @property Cross[] $crosses
 * @property FlyGene $flyGene
 * @property OrderNumber $orderNumber
 * @property StockType $stockType
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_id', 'stock_type_id', 'order_number_id', 'fly_gene_id'], 'required'],
            [['stock_id', 'stock_type_id', 'order_number_id', 'fly_gene_id'], 'integer'],
            [['stock_remark'], 'string'],
            [['stock_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stock_id' => 'Stock Id',
            'stock_type_id' => 'Stock Type Id',
            'order_number_id' => 'Order Number Id',            
            'fly_gene_id' => 'Fly Gene Id',
            'stock_remark' => 'Stock Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrosses()
    {
        return $this->hasMany(Cross::className(), ['stock_id' => 'stock_id']);
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
    public function getOrderNumber()
    {
        return $this->hasOne(OrderNumber::className(), ['order_number_id' => 'order_number_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockType()
    {
        return $this->hasOne(StockType::className(), ['stock_type_id' => 'stock_type_id']);
    }
}
