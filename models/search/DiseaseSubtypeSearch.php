<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\DiseaseSubtype;

/**
 * DiseaseSubtypeSearch represents the model behind the search form about `app\models\db\DiseaseSubtype`.
 */
class DiseaseSubtypeSearch extends DiseaseSubtype
{
    public $diseaseTypeName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disease_subtype_id', 'disease_type_id', 'omim_disease', 'sysid_yes_no'], 'integer'],
            [['diseaseTypeName', 'disease_subtype', 'disease_subtype_remark'], 'safe'],
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
        $query = DiseaseSubtype::find();
        
        $query->joinWith('diseaseType');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['diseaseTypeName'] = [
            'asc' => ['disease_type.disease_type' => SORT_ASC],
            'desc' => ['disease_type.disease_type' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'disease_subtype_id' => $this->disease_subtype_id,
            'disease_type_id' => $this->disease_type_id,
            'omim_disease' => $this->omim_disease,
            'sysid_yes_no' => $this->sysid_yes_no,
        ]);

        $query->andFilterWhere(['like', 'disease_subtype', $this->disease_subtype])
            ->andFilterWhere(['like', 'disease_subtype_remark', $this->disease_subtype_remark])
            ->andFilterWhere(['like', 'disease_type.disease_type', $this->diseaseTypeName]);

        return $dataProvider;
    }
}
