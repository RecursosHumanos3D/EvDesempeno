<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planaccion".
 *
 * @property integer $idPlanAccion
 * @property string $textoUno
 * @property integer $idDependencia
 */
class Planaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDependencia'], 'required'],
            [['idDependencia'], 'integer'],
            [['textoUno'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPlanAccion' => 'Id Plan Accion',
            'textoUno' => 'Plan de mejoramiento recomendado(Capacitacion, metas, otros)',
            'idDependencia' => 'Id Dependencia',
        ];
    }
}
