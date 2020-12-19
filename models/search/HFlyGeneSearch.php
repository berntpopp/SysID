<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HFlyGene;

/**
 * FlyGeneSearch represents the model behind the search form about `app\models\db\FlyGene`.
 */
class HFlyGeneSearch extends HFlyGene
{
    public $cg_number;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fly_gene_id'], 'integer'],
            [['cg_number', 'flybase_id', 'gene_name', 'gene_symbol', 'gene_synonyms', 'secondary_flybase_ids', 'fly_gene_remark'], 'safe'],
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

    public function search($params)
    {
        $query = HFlyGene::find();        

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
            'fly_gene_id' => $this->fly_gene_id,
        ]);

        $query->andFilterWhere(['like', 'flybase_id', $this->flybase_id])
            ->andFilterWhere(['like', 'gene_name', $this->gene_name])
            ->andFilterWhere(['like', 'gene_symbol', $this->gene_symbol])
            ->andFilterWhere(['like', 'gene_synonyms', $this->gene_synonyms])
            ->andFilterWhere(['like', 'secondary_flybase_ids', $this->secondary_flybase_ids])
            ->andFilterWhere(['like', 'fly_gene_remark', $this->fly_gene_remark])
            ->andFilterWhere(['like', 'cg_number', $this->cg_number]);

        return $dataProvider;
    }
}
