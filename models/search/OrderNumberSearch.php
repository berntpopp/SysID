<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\OrderNumber;

/**
 * OrderNumberSearch represents the model behind the search form about `app\models\db\OrderNumber`.
 */
class OrderNumberSearch extends OrderNumber
{
    public $source;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number_id', 'order_number_source_id'], 'integer'],
            [['order_number', 'order_number_remark', 'source'], 'safe'],
            [['order_number_svalue'], 'number'],
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
        $query = OrderNumber::find();

        $query->joinWith(['orderNumberSource']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['source'] = [
            'asc' => ['source' => SORT_ASC],
            'desc' => ['source' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'order_number_id' => $this->order_number_id,
            'order_number_source_id' => $this->order_number_source_id,
            'order_number_svalue' => $this->order_number_svalue,
        ]);

        $query->andFilterWhere(['like', 'order_number', $this->order_number])
                ->andFilterWhere(['like', 'order_number_remark', $this->order_number_remark])
                ->andFilterWhere(['like', 'order_number_source.source', $this->source]);

        return $dataProvider;
    }

}
