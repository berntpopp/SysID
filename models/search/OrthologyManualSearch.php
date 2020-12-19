<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HumanFlyOrthologyManual;

/**
 * OrthologyManualSearch represents the model behind the search form about `app\models\db\HumanFlyOrthologyManual`.
 */
class OrthologyManualSearch extends HumanFlyOrthologyManual
{
    public $human_symbol;
    public $flybase_id;
    public $orthology_source;
    public $orthology_relationship;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_fly_orthology_manual_id', 'human_gene_id', 'fly_gene_id', 'orthology_relationship_id', 'orthology_source_id', 'to_be_investigated_2013', 'entry_user_id', 'update_user_id'], 'integer'],
            [['date_of_entry', 'date_of_update', 'human_fly_manual_remark','human_symbol','flybase_id','orthology_source','orthology_relationship'], 'safe'],
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
        $query = HumanFlyOrthologyManual::find();
        
        $query->joinWith(['flyGene'])->joinWith(['humanGene'])->joinWith(['orthologySource'])->joinWith(['orthologyRelationship']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['flybase_id'] = [
            'asc' => ['flybase_id' => SORT_ASC],
            'desc' => ['flybase_id' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['human_symbol'] = [
            'asc' => ['human_gene.gene_symbol' => SORT_ASC],
            'desc' => ['human_gene.gene_symbol' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['orthology_relationship'] = [
            'asc' => ['orthology_relationship' => SORT_ASC],
            'desc' => ['orthology_relationship' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['orthology_source'] = [
            'asc' => ['orthology_source' => SORT_ASC],
            'desc' => ['orthology_source' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'human_fly_orthology_manual_id' => $this->human_fly_orthology_manual_id,
            'human_gene_id' => $this->human_gene_id,
            'fly_gene_id' => $this->fly_gene_id,
            'orthology_relationship_id' => $this->orthology_relationship_id,
            'orthology_source_id' => $this->orthology_source_id,
            'to_be_investigated_2013' => $this->to_be_investigated_2013,
            'date_of_entry' => $this->date_of_entry,
            'entry_user_id' => $this->entry_user_id,
            'date_of_update' => $this->date_of_update,
            'update_user_id' => $this->update_user_id,
        ]);

        $query->andFilterWhere(['like', 'human_fly_manual_remark', $this->human_fly_manual_remark])
                ->andFilterWhere(['like', 'fly_gene.flybase_id', $this->flybase_id])
                ->andFilterWhere(['like', 'human_gene.gene_symbol', $this->human_symbol])
                ->andFilterWhere(['like', 'orthology_relationship.orthology_relationship', $this->orthology_relationship])
                ->andFilterWhere(['like', 'orthology_source.orthology_source', $this->orthology_source]);

        return $dataProvider;
    }
}
