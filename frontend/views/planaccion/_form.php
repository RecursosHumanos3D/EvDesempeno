<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Planaccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planaccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'textoUno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'textoDos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idEtapas')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
