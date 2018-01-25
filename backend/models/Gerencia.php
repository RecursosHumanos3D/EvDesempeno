<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gerencia".
 *
 * @property integer $idGerencia
 * @property string $nombreGerencia
 */
class Gerencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gerencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreGerencia'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGerencia' => 'Id Gerencia',
            'nombreGerencia' => 'Nombre Gerencia',
        ];
    }
}
