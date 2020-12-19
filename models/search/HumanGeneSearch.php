<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HumanGene;

/**
 * HumanGeneSearch represents the model behind the search form about `app\models\db\HumanGene`.
 */
class HumanGeneSearch extends HumanGene
{
    public $geneTypeName;    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_id', 'entrez_id', 'gene_type_id', 'hpsd'], 'integer'],
            [['geneTypeName', 'sysid_id', 'chromosome_location', 'gene_symbol', 'gene_description', 'gene_synonyms', 'omim_id', 'ensembl_id', 'hprd_id', 'hgnc_id', 'human_gene_remark'], 'safe'],
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
        $query = HumanGene::find();
        
        $query->joinWith('geneType');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['geneTypeName'] = [
            'asc' => ['gene_type.gene_type' => SORT_ASC],
            'desc' => ['gene_type.gene_type' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'human_gene_id' => $this->human_gene_id,
            'entrez_id' => $this->entrez_id,
            'gene_type_id' => $this->gene_type_id,
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
            ->andFilterWhere(['like', 'gene_type.gene_type', $this->geneTypeName]);            

        return $dataProvider;
    }
}
