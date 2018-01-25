<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluacion_intermedia".
 *
 * @property integer $idAutoNumerico
 * @property integer $idCompetencias
 * @property integer $idConductas
 * @property integer $idEvalVal
 * @property integer $idEtapas
 * @property integer $idDependencias
 * @property string $comentario
 * @property integer $nombreCompetencia
 * @property string $promedio
 */
class EvaluacionIntermedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evaluacion_intermedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCompetencias', 'idConductas', 'idEvalVal', 'idEtapas', 'idDependencias', 'comentario'], 'required'],
            [['idCompetencias','promedio', 'idConductas', 'idEvalVal', 'idEtapas', 'idDependencias'], 'integer'],
            [['comentario'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAutoNumerico' => 'Id Auto Numerico',
            'idCompetencias' => 'Id Competencias',
            'idConductas' => 'Id Conductas',
            'idEvalVal' => 'Id Eval Val',
            'idEtapas' => 'Id Etapas',
            'idDependencias' => 'Id Dependencias',
            'comentario' => 'Comentario',
        ];
    }
}
