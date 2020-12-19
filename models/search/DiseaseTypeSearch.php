<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\DiseaseType;

/**
 * DiseaseTypeSearch represents the model behind the search form about `app\models\db\DiseaseType`.
 */
class DiseaseTypeSearch extends DiseaseType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disease_type_id'], 'integer'],
            [['disease_type', 'disease_type_remark'], 'safe'],
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
        $query = DiseaseType::find();

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
            'disease_type_id' => $this->disease_type_id,
        ]);

        $query->andFilterWhere(['like', 'disease_type', $this->disease_type])
            ->andFilterWhere(['like', 'disease_type_remark', $this->disease_type_remark]);

        return $dataProvider;
    }
}
