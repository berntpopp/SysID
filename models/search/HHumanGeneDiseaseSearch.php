<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\HHumanGeneDiseaseConnect;

/**
 * HumanGeneDiseaseSearch represents the model behind the search form about `app\models\db\HumanGeneDiseaseConnect`.
 */
class HHumanGeneDiseaseSearch extends HHumanGeneDiseaseConnect
{
 /*
  human_gene_disease_id
  gene_symbol
  inheritance_pattern
  inheritance_type
  main_class_type
  additional_class_type
  limited_confidence_criterion
  sysid_yes_no
  disease_subtype
  disease_type
  alternative_names
  additional_references
  omim_disease
  disease_subtype_remark
  gene_review
  haploinsufficiency_yes_no
  clinical_synopsis
  human_gene_disease_remark

  */
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['human_gene_disease_id', 'human_gene_id', 'sysid_yes_no', 'haploinsufficiency_yes_no','limited_confidence_criterion','omim_disease'], 'integer'],
            [['gene_symbol', 'inheritance_pattern', 'inheritance_type','main_class', 'accompanying_phenotype', 'disease_subtype', 'disease_type', 'alternative_names', 'additional_references','disease_subtype_remark', 'clinical_synopsis','gene_review', 'human_gene_disease_remark'], 'safe'],
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
        $query = HHumanGeneDiseaseConnect::find();

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
            'sysid_yes_no' => $this->sysid_yes_no,            
            'haploinsufficiency_yes_no' => $this->haploinsufficiency_yes_no,
            'limited_confidence_criterion' => $this->limited_confidence_criterion,
            'omim_disease' => $this->omim_disease,            
        ]);

        $query->andFilterWhere(['like', 'gene_symbol', $this->gene_symbol])
            ->andFilterWhere(['like', 'inheritance_pattern', $this->inheritance_pattern])
            ->andFilterWhere(['like', 'inheritance_type', $this->inheritance_type])
            ->andFilterWhere(['like', 'main_class', $this->main_class])
            ->andFilterWhere(['like', 'accompanying_phenotype', $this->accompanying_phenotype])
            ->andFilterWhere(['like', 'disease_subtype', $this->disease_subtype])
            ->andFilterWhere(['like', 'disease_type', $this->disease_type])
            ->andFilterWhere(['like', 'alternative_names', $this->alternative_names])
            ->andFilterWhere(['like', 'additional_references', $this->additional_references])
            ->andFilterWhere(['like', 'disease_subtype_remark', $this->disease_subtype_remark])
            ->andFilterWhere(['like', 'clinical_synopsis', $this->clinical_synopsis])
            ->andFilterWhere(['like', 'gene_review', $this->gene_review])
            ->andFilterWhere(['like', 'human_gene_disease_remark', $this->human_gene_disease_remark]);

        return $dataProvider;
    }
}
