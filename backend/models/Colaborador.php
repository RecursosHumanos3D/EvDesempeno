<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colaborador".
 *
 * @property integer $rutColaborador
 * @property string $nombreColaborador
 * @property string $apellidosColaborador
 * @property integer $idGerencia
 * @property integer $idCargo
 * @property integer $idRol
 * @property integer $idArea
 * @property string $email
 * @property string $fechaIngreso
 * @property integer $estado
 * @property string $password
 */
class Colaborador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'colaborador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreColaborador', 'apellidosColaborador'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 150],
            [['password'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rutColaborador' => 'Rut Colaborador',
            'nombreColaborador' => 'Nombre Colaborador',
            'apellidosColaborador' => 'Apellidos Colaborador',
            'idGerencia' => 'Id Gerencia',
            'idCargo' => 'Id Cargo',
            'idRol' => 'Id Rol',
            'idArea' => 'Id Area',
            'email' => 'Email',
            'fechaIngreso' => 'Fecha Ingreso',
            'estado' => 'Estado',
            'password' => 'Password',
        ];
    }
    
     public function getCargo()
    {
        return $this->hasOne(Cargos::className(), ['idCargo' => 'idCargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['idArea' => 'idArea']);
    }

    
    
}
