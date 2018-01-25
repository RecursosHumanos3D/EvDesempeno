<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ColaboradorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaborador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rutColaborador') ?>

    <?= $form->field($model, 'nombreColaborador') ?>

    <?= $form->field($model, 'apellidosColaborador') ?>

    <?= $form->field($model, 'rutEmpresa') ?>

    <?= $form->field($model, 'idCargo') ?>

    <?php // echo $form->field($model, 'idRol') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'fechaIngreso') ?>

    <?php // echo $form->field($model, 'idArea') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'idNivel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
