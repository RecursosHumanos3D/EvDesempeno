<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Cargos */

$this->title = 'Suba su documento de Acuerdo';

?>

<div class="cargos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    
<div class="cargos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'ruta')->fileInput() ?>
    <input type="hidden" name="idDependencia"  value="<?php echo $id; ?>"/>  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Subir Acuerdo' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>