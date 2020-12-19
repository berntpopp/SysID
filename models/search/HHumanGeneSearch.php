<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HHumanGene;

/**
 * HumanGeneSearch represents the model behind the search form about `app\models\db\HumanGene`.
 */
class HHumanGeneSearch extends HHumanGene
{    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_id', 'entrez_id', 'hpsd'], 'integer'],
            [['sysid_id', 'gene_type', 'chromosome_location', 'gene_symbol', 'gene_description', 'gene_synonyms', 'omim_id', 'ensembl_id', 'hprd_id', 'hgnc_id', 'human_gene_remark', 'gene_group', 'super_go'], 'safe'],
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
        $query = HHumanGene::find();        

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
            'human_gene_id' => $this->human_gene_id,
            'entrez_id' => $this->entrez_id,            
            'hpsd' => $this->hpsd,
        ]);

        $query->andFilterWhere(['like', 'sysid_id', $this->sysid_id])
            ->andFilterWhere(['like', 'chromosome_location', $this->chromosome_location])
            ->andFilterWhere(['like', 'gene_symbol', $this->gene_symbol])
            ->andFilterWhere(['like', 'gene_description', $this->gene_description])
            ->andFilterWhere(['like', 'gene_synonyms', $this->gene_synonyms])
            ->andFilterWhere(['like', 'omim_id', $this->omim_id])
            ->andFilterWhere(['like', 'ensembl_id', $this->ensembl_id])
            ->andFilterWhere(['like', 'hprd_id', $this->hprd_id])
            ->andFilterWhere(['like', 'hgnc_id', $this->hgnc_id])
            ->andFilterWhere(['like', 'human_gene_remark', $this->human_gene_remark])
            ->andFilterWhere(['like', 'gene_type', $this->gene_type])
            ->andFilterWhere(['like', 'gene_group', $this->gene_group])
            ->andFilterWhere(['like', 'super_go', $this->super_go]);

        return $dataProvider;
    }
}
