<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HumanGeneDiseaseConnect;

/**
 * HumanGeneDiseaseSearch represents the model behind the search form about `app\models\db\HumanGeneDiseaseConnect`.
 */
class HumanGeneDiseaseSearch extends HumanGeneDiseaseConnect
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_disease_id', 'human_gene_id', 'disease_subtype_id', 'inheritance_pattern_id', 'inheritance_type_id', 'haploinsufficiency_yes_no', 'confidence_criteria_limit_no_patient', 'entry_user_id', 'update_user_id'], 'integer'],
            [['alternative_names', 'additional_references', 'clinical_synopsis', 'date_of_entry', 'date_of_update', 'human_gene_disease_remark'], 'safe'],
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
        $query = HumanGeneDiseaseConnect::find();

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
            'human_gene_disease_id' => $this->human_gene_disease_id,
            'human_gene_id' => $this->human_gene_id,
            'disease_subtype_id' => $this->disease_subtype_id,
            'inheritance_pattern_id' => $this->inheritance_pattern_id,
            'inheritance_type_id' => $this->inheritance_type_id,
            'haploinsufficiency_yes_no' => $this->haploinsufficiency_yes_no,
            'confidence_criteria_limit_no_patient' => $this->confidence_criteria_limit_no_patient,
            'date_of_entry' => $this->date_of_entry,
            'entry_user_id' => $this->entry_user_id,
            'date_of_update' => $this->date_of_update,
            'update_user_id' => $this->update_user_id,
        ]);

        $query->andFilterWhere(['like', 'alternative_names', $this->alternative_names])
            ->andFilterWhere(['like', 'additional_references', $this->additional_references])
            ->andFilterWhere(['like', 'clinical_synopsis', $this->clinical_synopsis])
            ->andFilterWhere(['like', 'human_gene_disease_remark', $this->human_gene_disease_remark]);

        return $dataProvider;
    }
}
