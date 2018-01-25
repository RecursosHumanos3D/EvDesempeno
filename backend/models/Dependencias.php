<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dependencias".
 *
 * @property integer $idDependencias
 * @property integer $Colaborador_rutColaborador
 * @property integer $Colaborador_rutColaborador1
 * @property integer $estado
 */
class Dependencias extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'dependencias';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Colaborador_rutColaborador', 'Colaborador_rutColaborador1'], 'required'],
            [['Colaborador_rutColaborador', 'Colaborador_rutColaborador1', 'estado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idDependencias' => 'Id Dependencias',
            'Colaborador_rutColaborador' => 'Colaborador Rut Colaborador',
            'Colaborador_rutColaborador1' => 'Colaborador Rut Colaborador1',
            'estado' => 'Estado',
        ];
    }

    public function getColaborador1() {
        return $this->hasOne(Colaborador::className(), ['rutColaborador' => 'Colaborador_rutColaborador']);
    }

     public function getColaborador2()  {
        return $this->hasOne(Colaborador::className(), ['rutColaborador' => 'Colaborador_rutColaborador1']);
    }

}
