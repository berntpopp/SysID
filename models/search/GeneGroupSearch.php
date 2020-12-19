<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\GeneGroup;

/**
 * GeneGroupSearch represents the model behind the search form about `app\models\db\GeneGroup`.
 */
class GeneGroupSearch extends GeneGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gene_group_id'], 'integer'],
            [['gene_group', 'gene_group_remark'], 'safe'],
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
        $query = GeneGroup::find();

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
            'gene_group_id' => $this->gene_group_id,
        ]);

        $query->andFilterWhere(['like', 'gene_group', $this->gene_group])
            ->andFilterWhere(['like', 'gene_group_remark', $this->gene_group_remark]);

        return $dataProvider;
    }
}
