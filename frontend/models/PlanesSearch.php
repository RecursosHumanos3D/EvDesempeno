<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Planes;
use yii\db\Query;

/**
 * PlanesSearch represents the model behind the search form about `app\models\Planes`.
 */
class PlanesSearch extends Planes {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['idPlanes', 'idPlanAccion', 'idCompetencias'], 'integer'],
            [['texto1', 'texto3'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = new Query;

        $query->select(['Planes.texto1', 'Planes.texto2', 'Planes.texto3', 'Planes.idCompetencias', 'Planes.idPlanAccion', 'Planes.idPlanes', 'competencias.nombreCompetencia'])
                 ->from('Planes')
                ->join('INNER JOIN', 'competencias', 'competencias.idCompetencias=Planes.idCompetencias ');

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
            'idPlanes' => $this->idPlanes,
            'idPlanAccion' => $this->idPlanAccion,
            'idCompetencias' => $this->idCompetencias,
        ]);

        $query->andFilterWhere(['like', 'texto1', $this->texto1])
                ->andFilterWhere(['like', 'texto3', $this->texto3]);

        return $dataProvider;
    }

    public function search2($idPlan) {  // var_dump($idPlan);die();
        $query = new Query;
        $query->select(['Planes.texto1', 'Planes.texto3', 'Planes.idCompetencias', 'Planes.idPlanAccion', 'Planes.idPlanes', 'competencias.nombreCompetencia'])
                ->from('Planes')
                ->join('INNER JOIN', 'competencias', 'competencias.idCompetencias=Planes.idCompetencias ')
                ->where(['Planes.idPlanAccion' => $idPlan]);
        // var_dump($query);die();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($idPlan);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
        ]);

        $query->andFilterWhere(['like', 'texto1', $this->texto1])
                ->andFilterWhere(['like', 'texto3', $this->texto3]);

        return $dataProvider;
    }

}
