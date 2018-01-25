<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CompCond;

/**
 * CompCondSearch represents the model behind the search form about `app\models\CompCond`.
 */
class CompCondSearch extends CompCond
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idComp_Cond', 'idCompetencias', 'idConductas'], 'integer'],
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
        $query = CompCond::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idComp_Cond' => $this->idComp_Cond,
            'idCompetencias' => $this->idCompetencias,
            'idConductas' => $this->idConductas,
        ]);

        return $dataProvider;
    }
}
