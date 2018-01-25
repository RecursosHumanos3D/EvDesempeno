<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Colaborador;

/**
 * ColaboradorSearch represents the model behind the search form about `app\models\Colaborador`.
 */
class ColaboradorSearch extends Colaborador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rutColaborador', 'rutEmpresa', 'idCargo', 'idRol', 'idArea', 'estado', 'idNivel'], 'integer'],
            [['nombreColaborador', 'apellidosColaborador', 'email', 'fechaIngreso'], 'safe'],
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
        $query = Colaborador::find();

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
            'rutColaborador' => $this->rutColaborador,
            'rutEmpresa' => $this->rutEmpresa,
            'idCargo' => $this->idCargo,
            'idRol' => $this->idRol,
            'fechaIngreso' => $this->fechaIngreso,
            'idArea' => $this->idArea,
            'estado' => $this->estado,
            'idNivel' => $this->idNivel,
        ]);

        $query->andFilterWhere(['like', 'nombreColaborador', $this->nombreColaborador])
            ->andFilterWhere(['like', 'apellidosColaborador', $this->apellidosColaborador])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
