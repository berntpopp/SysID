<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $stock_id
 * @property string $stock_type
 * @property string $stock_type_remark
 * @property string $order_number
 * @property string $order_number_svalue
 * @property string $order_number_remark
 * @property string $order_number_source
 * @property string $order_number_source_remark
 * @property integer $fly_gene_id
 * @property string $flybase_id
 * @property string $stock_remark
 * @property string $driver_stock_id
 */
class HStock extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'h_stock';
    }
    
    public static function primaryKey()
    {
        return ['stock_id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_id', 'fly_gene_id'], 'required'],
            [['stock_id',  'fly_gene_id'], 'integer'],
            [['stock_remark','stock_type_remark','stock_type','order_number','flybase_id','order_number_remark','order_number_source_remark','driver_stock_id'], 'string'],
            [['stock_id'], 'unique'],
            [['order_number_svalue'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stock_id' => 'Stock Id',
            'stock_type' => 'Stock Type',
            'stock_type_remark' => 'Stock Type Remark',
            'order_number' => 'Order Number',
            'order_number_svalue' => 'Order Number S Value',
            'order_number_remark' => 'Order Number Remark',
            'order_number_source' => 'Order Number Source',
            'order_number_source_remark' => 'Order Number Source Remark',
            'fly_gene_id' => 'Fly Gene Id',
            'flybase_id' => 'Flybase Id',
            'stock_remark' => 'Stock Remark',
            'driver_stock_id' => 'Driver Stock'
        ];
    }

}
