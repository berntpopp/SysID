<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HStock;

/**
 * StockSearch represents the model behind the search form about `app\models\db\Stock`.
 */
class HStockSearch extends HStock
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_id', 'fly_gene_id'], 'integer'],
            [['stock_type', 'stock_type_remark','order_number', 'order_number_svalue', 'order_number_remark', 'order_number_source', 'order_number_source_remark', 'flybase_id', 'stock_remark','driver_stock_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = HStock::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'stock_id' => $this->stock_id,            
            'fly_gene_id' => $this->fly_gene_id,
        ]);

        $query->andFilterWhere(['like', 'stock_type', $this->stock_type])
                ->andFilterWhere(['like', 'order_number', $this->order_number])
                ->andFilterWhere(['like', 'order_number_svalue', $this->order_number_svalue])
                ->andFilterWhere(['like', 'order_number_remark', $this->order_number_remark])
                ->andFilterWhere(['like', 'order_number_source', $this->order_number_source])
                ->andFilterWhere(['like', 'order_number_source_remark', $this->order_number_source_remark])
                ->andFilterWhere(['like', 'flybase_id', $this->flybase_id])
                ->andFilterWhere(['like', 'stock_remark', $this->stock_remark])
                ->andFilterWhere(['like', 'driver_stock_id', $this->driver_stock_id]);

        return $dataProvider;
    }

}
