<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comp_cond".
 *
 * @property integer $idComp_Cond
 * @property integer $idCompetencias
 * @property integer $idConductas
 *
 * @property Competencias $idCompetencias0
 * @property Conductas $idConductas0
 */
class CompCond extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comp_cond';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCompetencias', 'idConductas'], 'required'],
            [['idCompetencias', 'idConductas'], 'integer'],
            [['idCompetencias'], 'exist', 'skipOnError' => true, 'targetClass' => Competencias::className(), 'targetAttribute' => ['idCompetencias' => 'idCompetencias']],
            [['idConductas'], 'exist', 'skipOnError' => true, 'targetClass' => Conductas::className(), 'targetAttribute' => ['idConductas' => 'idConductas']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idComp_Cond' => 'Id Comp  Cond',
            'idCompetencias' => 'Id Competencias',
            'idConductas' => 'Id Conductas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCompetencias0()
    {
        return $this->hasOne(Competencias::className(), ['idCompetencias' => 'idCompetencias']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConductas0()
    {
        return $this->hasOne(Conductas::className(), ['idConductas' => 'idConductas']);
    }
}
