<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EvaluacionIntermediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-intermedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAutoNumerico') ?>

    <?= $form->field($model, 'idCompetencias') ?>

    <?= $form->field($model, 'idConductas') ?>

    <?= $form->field($model, 'idEvalVal') ?>

    <?= $form->field($model, 'idEtapas') ?>

    <?php // echo $form->field($model, 'idDependencias') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
