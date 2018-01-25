<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipocompetencia".
 *
 * @property integer $idTipoCompetencia
 * @property string $nombreTipoCompetencia
 *
 * @property Competencias[] $competencias
 */
class Tipocompetencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipocompetencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreTipoCompetencia'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoCompetencia' => 'Id Tipo Competencia',
            'nombreTipoCompetencia' => 'Nombre Tipo Competencia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetencias()
    {
        return $this->hasMany(Competencias::className(), ['idTipoCompetencia' => 'idTipoCompetencia']);
    }
}
