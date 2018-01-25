<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresas".
 *
 * @property integer $rutEmpresa
 * @property string $nombreEmpresa
 *
 * @property Colaborador[] $colaboradors
 */
class Empresas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rutEmpresa'], 'required'],
            [['rutEmpresa'], 'integer'],
            [['nombreEmpresa'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rutEmpresa' => 'Rut Empresa',
            'nombreEmpresa' => 'Nombre Empresa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColaboradors()
    {
        return $this->hasMany(Colaborador::className(), ['rutEmpresa' => 'rutEmpresa']);
    }
}
