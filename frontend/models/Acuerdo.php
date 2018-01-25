<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acuerdo".
 *
 * @property integer $idacuerdo
 * @property string $ruta
 * @property integer $idDependencia
 */
class Acuerdo extends \yii\db\ActiveRecord {

    public $file;
    
    public static function tableName() {
        return 'acuerdo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
         ['ruta', 'required', 'message' => 'Por favor seleccione un archivo.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'idacuerdo' => 'Idacuerdo',
            'ruta' => 'Ruta',
            'idDependencia' => 'Id Dependencia',
        ];
    }

}
