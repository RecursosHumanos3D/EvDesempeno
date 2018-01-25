<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Competencias;

/**
 * CompetenciasSearch represents the model behind the search form about `app\models\Competencias`.
 */
class CompetenciasSearch extends Competencias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCompetencias', 'idRol'], 'integer'],
            [['nombreCompetencia', 'descripcionCompetencia'], 'safe'],
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
        $query = Competencias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idCompetencias' => $this->idCompetencias,
            'idRol' => $this->idRol,
        ]);

        $query->andFilterWhere(['like', 'nombreCompetencia', $this->nombreCompetencia])
            ->andFilterWhere(['like', 'descripcionCompetencia', $this->descripcionCompetencia]);

        return $dataProvider;
    }
}
