<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colaborador".
 *
 * @property integer $rutColaborador
 * @property string $nombreColaborador
 * @property string $apellidosColaborador
 * @property integer $rutEmpresa
 * @property integer $idCargo
 * @property integer $idRol
 * @property string $email
 * @property string $fechaIngreso
 * @property integer $idArea
 *
 * @property Cargos $idCargo0
 * @property Area $idArea0
 * @property Empresas $rutEmpresa0
 * @property Rol $idRol0
 * @property Dependencias[] $dependencias
 * @property Dependencias[] $dependencias0
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
            [['rutEmpresa', 'idCargo', 'idRol', 'idArea'], 'integer'],
            [['fechaIngreso'], 'safe'],
            [['nombreColaborador', 'apellidosColaborador'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 150],
          
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
            'rutEmpresa' => 'Empresa a la que pertenece',
            'idCargo' => 'Cargo',
            'idRol' => 'Rol',
            'email' => 'Email',
            'fechaIngreso' => 'Fecha Ingreso',
            'idArea' => 'Area ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCargo0()
    {
        return $this->hasOne(Cargos::className(), ['idCargo' => 'idCargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdArea0()
    {
        return $this->hasOne(Area::className(), ['idArea' => 'idArea']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutEmpresa0()
    {
        return $this->hasOne(Empresas::className(), ['rutEmpresa' => 'rutEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependencias()
    {
        return $this->hasMany(Dependencias::className(), ['Colaborador_rutColaborador' => 'rutColaborador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependencias0()
    {
        return $this->hasMany(Dependencias::className(), ['Colaborador_rutColaborador1' => 'rutColaborador']);
    }
}
