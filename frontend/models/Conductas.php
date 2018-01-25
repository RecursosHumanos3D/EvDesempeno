<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conductas".
 *
 * @property integer $idConductas
 * @property string $nombreConductas
 * @property integer $idCompetencia
 * @property integer $idNivel
 *
 * @property CompCond[] $compConds
 */
class Conductas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conductas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCompetencia', 'idNivel'], 'integer'],
            [['nombreConductas'], 'string', 'max' => 600],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idConductas' => 'Id Conductas',
            'nombreConductas' => 'Nombre Conductas',
            'idCompetencia' => 'Id Competencia',
            'idNivel' => 'Id Nivel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompConds()
    {
        return $this->hasMany(CompCond::className(), ['idConductas' => 'idConductas']);
    }
}
