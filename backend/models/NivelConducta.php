<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_conducta".
 *
 * @property integer $idNivel
 * @property string $nombreNivel
 */
class NivelConducta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_conducta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreNivel'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNivel' => 'Id Nivel',
            'nombreNivel' => 'Nombre Nivel',
        ];
    }
}
