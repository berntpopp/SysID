<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "order_number_source".
 *
 * @property integer $order_number_source_id
 * @property string $source
 * @property string $order_number_source_remark
 *
 * @property OrderNumber[] $orderNumbers
 */
class OrderNumberSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_number_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source'], 'required'],
            [['order_number_source_remark'], 'string'],
            [['source'], 'string', 'max' => 45],
            [['source'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_number_source_id' => 'Order Number Source ID',
            'source' => 'Source',
            'order_number_source_remark' => 'Order Number Source Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNumbers()
    {
        return $this->hasMany(OrderNumber::className(), ['order_number_source_id' => 'order_number_source_id']);
    }
}
