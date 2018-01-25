<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EvaluacionIntermedia;

/**
 * EvaluacionIntermediaSearch represents the model behind the search form about `app\models\EvaluacionIntermedia`.
 */
class EvaluacionIntermediaSearch extends EvaluacionIntermedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAutoNumerico', 'idCompetencias', 'idConductas', 'idEvalVal', 'idEtapas', 'idDependencias'], 'integer'],
            [['comentario'], 'safe'],
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
        $query = EvaluacionIntermedia::find();

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
            'idAutoNumerico' => $this->idAutoNumerico,
            'idCompetencias' => $this->idCompetencias,
            'idConductas' => $this->idConductas,
            'idEvalVal' => $this->idEvalVal,
            'idEtapas' => $this->idEtapas,
            'idDependencias' => $this->idDependencias,
        ]);

        $query->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
