<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Colaborador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaborador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rutColaborador')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nombreColaborador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidosColaborador')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'fechaIngreso')->widget(DatePicker::classname(), [
	'options' => ['placeholder' => 'Seleccione la fecha de Ingreso ...'],
	'pluginOptions' => [
        'todayHighlight' => true,
        'todayBtn' => true,
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
	]
       ]);
    
            
     ?>
    
     <?= $form->field($model, 'rutEmpresa')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Empresas::find()->orderBy('rutEmpresa')->all(), 'rutEmpresa', 'nombreEmpresa'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione una empresa:::::::::'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
        ?>
     <?= $form->field($model, 'idCargo')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Cargos::find()->orderBy('idCargo')->all(), 'idCargo', 'nombreCargo'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione un Cargo:::::::::'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
        ?>
     <?= $form->field($model, 'idRol')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Rol::find()->orderBy('idRol')->all(), 'idRol', 'nombreRol'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione un ROL:::::::::'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
        ?>
     <?= $form->field($model, 'idArea')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(\app\models\Area::find()->orderBy('idArea')->all(), 'idArea', 'nombreArea'),
    'language' => 'es',
    'options' => ['placeholder' => 'Seleccione un Area:::::::::'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ]);
        ?>
    

    

    
    
    <?= $form->field($model, 'email')->widget(\yii\widgets\MaskedInput::className(), [
    'clientOptions' => [
        'alias' =>  'email'
    ],
]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-raised btn-success' : 'btn btn-raised btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
