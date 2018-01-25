<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "competencias".
 *
 * @property integer $idCompetencias
 * @property string $nombreCompetencia
 * @property string $descripcionCompetencia
 * @property integer $idRol
 *
 * @property CompCond[] $compConds
 * @property Rol $idRol0
 * @property Conductas[] $conductas
 */
class Competencias extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'competencias';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['descripcionCompetencia', 'idRol'], 'required'],
            [['idRol'], 'integer'],
            [['nombreCompetencia'], 'string', 'max' => 200],
            [['descripcionCompetencia'], 'string', 'max' => 500],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idCompetencias' => 'Id Competencias',
            'nombreCompetencia' => 'Nombre Competencia',
            'descripcionCompetencia' => 'Descripcion Competencia',
            'idRol' => 'Id Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompConds() {
        return $this->hasMany(CompCond::className(), ['idCompetencias' => 'idCompetencias']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol() {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConductas() {
        return $this->hasMany(Conductas::className(), ['idCompetencia' => 'idCompetencias']);
    }



}
