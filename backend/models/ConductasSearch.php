<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Conductas;

/**
 * ConductasSearch represents the model behind the search form about `app\models\Conductas`.
 */
class ConductasSearch extends Conductas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idConductas', 'idCompetencia', 'idNivel'], 'integer'],
            [['nombreConductas'], 'safe'],
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
        $query = Conductas::find();

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
            'idConductas' => $this->idConductas,
            'idCompetencia' => $this->idCompetencia,
            'idNivel' => $this->idNivel,
        ]);

        $query->andFilterWhere(['like', 'nombreConductas', $this->nombreConductas]);

        return $dataProvider;
    }
}
