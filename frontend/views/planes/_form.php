<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Planes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'texto1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPlanAccion')->textInput() ?>

    <?= $form->field($model, 'idCompetencias')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
