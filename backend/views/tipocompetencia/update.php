<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocompetencia */

$this->title = 'Update Tipocompetencia: ' . $model->idTipoCompetencia;
$this->params['breadcrumbs'][] = ['label' => 'Tipocompetencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipoCompetencia, 'url' => ['view', 'id' => $model->idTipoCompetencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipocompetencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
