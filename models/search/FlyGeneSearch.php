<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\db\FlyGene;

/**
 * FlyGeneSearch represents the model behind the search form about `app\models\db\FlyGene`.
 */
class FlyGeneSearch extends FlyGene
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $whereSql = "";
        $parameters = [];

        if (isset($params["FlyGeneSearch"]))
        {
            $i = 0;
            foreach ($params["FlyGeneSearch"] as $key => $value)
            {
                if ($value !== "")
                {
                    $parameters[":$key"] = "%$value%";
                    
                    if ($i++ > 0)
                    {
                        $whereSql .= " AND $key LIKE :$key";
                    }
                    else
                    {
                        $whereSql .= " WHERE $key LIKE :$key";
                    }
                }
            }

//            $whereSql = "WHERE flybase_id LIKE :flybase_id
//                    AND gene_name LIKE :gene_name
//                    AND gene_symbol LIKE :gene_symbol
//                    AND gene_synonyms LIKE :gene_synonyms
//                    AND secondary_flybase_ids LIKE :secondary_flybase_ids
//                    AND cg_number LIKE :cg_number";
//
//            $parameters = [
//                ':flybase_id' => "%" + $params['FlyGeneSearch']['flybase_id'] + "%",
//                ':gene_name' => "%" + $params['FlyGeneSearch']['gene_name'] + "%",
//                ':gene_symbol' => "%" + $params['FlyGeneSearch']['gene_symbol'] + "%",
//                ':gene_synonyms' => "%" + $params['FlyGeneSearch']['gene_synonyms'] + "%",
//                ':secondary_flybase_ids' => "%" + $params['FlyGeneSearch']['secondary_flybase_ids'] + "%",
//                ':cg_number' => "%" + $params['FlyGeneSearch']['cgNumber'] + "%"
//            ];
        }

        $sql = "SELECT
                    f.fly_gene_id,
                    flybase_id,
                    gene_name,
                    gene_symbol,
                    gene_synonyms,
                    secondary_flybase_ids,
                    group_concat(cg_number SEPARATOR ',') as cg_number
                FROM fly_gene f
                LEFT JOIN cg_number_connect cgc ON f.fly_gene_id = cgc.fly_gene_id
                LEFT JOIN cg_number cgn ON cgc.cg_number_id = cgn.cg_number_id
                $whereSql
                GROUP BY f.fly_gene_id";


        $count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ($sql) t", $parameters)->queryScalar();
        
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'params' => $parameters,
            'totalCount' => (int)$count,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'flybase_id',
                    'gene_name',
                    'gene_symbol',
                    'gene_synonyms',
                    'secondary_flybase_ids',
                    'cg_number',
                ],
            ],
        ]);                
        
        return $dataProvider;
    }

    public function search2($params)
    {
        $query = FlyGene::find();        

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
            ->andFilterWhere(['like', 'cg_number.cg_number', $this->cgNumber]);

        return $dataProvider;
    }
}
