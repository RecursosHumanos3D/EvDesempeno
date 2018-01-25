<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompetenciasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idCompetencias') ?>

    <?= $form->field($model, 'nombreCompetencia') ?>

    <?= $form->field($model, 'descripcionCompetencia') ?>

    <?= $form->field($model, 'idRol') ?>

    <?= $form->field($model, 'idTipoCompetencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
