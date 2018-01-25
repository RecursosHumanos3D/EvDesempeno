<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlanesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPlanes') ?>

    <?= $form->field($model, 'texto1') ?>

    <?= $form->field($model, 'texto2') ?>

    <?= $form->field($model, 'texto3') ?>

    <?= $form->field($model, 'idPlanAccion') ?>

    <?php // echo $form->field($model, 'idCompetencias') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
