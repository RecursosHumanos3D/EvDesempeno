<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluacion_intermedia".
 *
 * @property integer $idAutoNumerico
 * @property integer $idCompetencias
 * @property integer $idConductas
 * @property integer $valor
 * @property integer $idDependencias
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
            [['idCompetencias', 'idConductas', 'valor', 'idDependencias'], 'required'],
            [['idCompetencias', 'idConductas', 'valor', 'idDependencias'], 'integer'],
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
            'valor' => 'Valor',
            'idDependencias' => 'Id Dependencias',
        ];
    }
}
