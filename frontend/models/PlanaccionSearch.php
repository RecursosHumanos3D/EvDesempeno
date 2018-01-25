<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Planaccion;

/**
 * PlanaccionSearch represents the model behind the search form about `app\models\Planaccion`.
 */
class PlanaccionSearch extends Planaccion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPlanAccion', 'idEtapas'], 'integer'],
            [['textoUno', 'textoDos'], 'safe'],
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
        $query = Planaccion::find();

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
            'idPlanAccion' => $this->idPlanAccion,
            'idEtapas' => $this->idEtapas,
        ]);

        $query->andFilterWhere(['like', 'textoUno', $this->textoUno])
            ->andFilterWhere(['like', 'textoDos', $this->textoDos]);

        return $dataProvider;
    }
}
