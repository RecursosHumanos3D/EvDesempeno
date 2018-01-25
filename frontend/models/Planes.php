<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planes".
 *
 * @property integer $idPlanes
 * @property string $texto1
 * @property string $texto2
 * @property string $texto3
 * @property integer $idPlanAccion
 * @property integer $idCompetencias
 */
class Planes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Planes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPlanAccion', 'idCompetencias'], 'integer'],
            [['texto1', 'texto3'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPlanes' => 'Id Planes',
            'texto1' => 'Descripción General del Plan (Objetivo general a cumplir)',
            'texto3' => 'Acciones a medir para el cumplimiento (Objetivos específicos para cumplir el plan) ',
            'idPlanAccion' => 'Id Plan Accion',
            'idCompetencias' => 'Competencia:',
        ];
    }
    
     public function getCompetencia()
    {
        return $this->hasOne(Competencias::className(), ['idCompetencias' => 'idCompetencias']);
    }
}
