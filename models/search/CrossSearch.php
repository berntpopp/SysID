<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Cross;

/**
 * CrossSearch represents the model behind the search form about `app\models\db\Cross`.
 */
class CrossSearch extends Cross
{
    public $sex_type;    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cross_id', 'stock_id', 'driver_stock_id', 'sex_id', 'temperature_id'], 'integer'],
            [['cross_remark','sex_type'], 'safe'],
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
        $query = Cross::find();
        
        $query->joinWith(['sex']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['sex_type'] = [
            'asc' => ['sex' => SORT_ASC],
            'desc' => ['sex' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'cross_id' => $this->cross_id,
            'stock_id' => $this->stock_id,
            'driver_stock_id' => $this->driver_stock_id,
            'sex_id' => $this->sex_id,
            'temperature_id' => $this->temperature_id,
        ]);

        $query->andFilterWhere(['like', 'cross_remark', $this->cross_remark])
                ->andFilterWhere(['like', 'sex.sex', $this->sex_type]);;

        return $dataProvider;
    }
}
