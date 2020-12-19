<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Stock;

/**
 * StockSearch represents the model behind the search form about `app\models\db\Stock`.
 */
class StockSearch extends Stock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_id', 'stock_type_id', 'order_number_id', 'fly_gene_id'], 'integer'],
            [['stock_remak'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Stock::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'stock_id' => $this->stock_id,
            'stock_type_id' => $this->stock_type_id,
            'order_number_id' => $this->order_number_id,
            'fly_gene_id' => $this->fly_gene_id,
        ]);

        $query->andFilterWhere(['like', 'stock_remak', $this->stock_remak]);

        return $dataProvider;
    }
}
