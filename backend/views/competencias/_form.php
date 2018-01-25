<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Competencias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreCompetencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcionCompetencia')->textInput(['maxlength' => true]) ?>

    
     <?=
        $form->field($model, "idRol")->widget(Select2::classname(), [
            'data' => ArrayHelper::map(app\models\Rol::find()->orderBy('idRol')->all(), 'idRol', 'nombreRol'),
            'language' => 'es',
            'options' => ['placeholder' => 'Asignar un Rol ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
