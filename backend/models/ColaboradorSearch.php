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
            [['rutColaborador'], 'integer'],
            [['nombreColaborador', 'apellidosColaborador','rutEmpresa', 'email', 'fechaIngreso', 'idCargo', 'idRol', 'idArea'], 'safe'],
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
        
        $query->joinWith('rutEmpresa0');
        $query->joinWith('idCargo0');
        $query->joinWith('idArea0');

        // grid filtering conditions
        $query->andFilterWhere([
            'rutColaborador' => $this->rutColaborador,
            
            'idRol' => $this->idRol,
            'fechaIngreso' => $this->fechaIngreso,
           
        ]);

        $query->andFilterWhere(['like', 'nombreColaborador', $this->nombreColaborador])
            ->andFilterWhere(['like', 'apellidosColaborador', $this->apellidosColaborador])
            ->andFilterWhere(['like', 'empresas.nombreEmpresa', $this->rutEmpresa])
            ->andFilterWhere(['like', 'cargos.nombreCargo', $this->idCargo])
            ->andFilterWhere(['like', 'area.nombreArea', $this->idArea])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
