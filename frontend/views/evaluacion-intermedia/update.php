<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EvaluacionIntermedia */

$this->title = 'Update Evaluacion Intermedia: ' . $model->idAutoNumerico;
$this->params['breadcrumbs'][] = ['label' => 'Evaluacion Intermedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAutoNumerico, 'url' => ['view', 'idAutoNumerico' => $model->idAutoNumerico, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas, 'idEvalVal' => $model->idEvalVal, 'idEtapas' => $model->idEtapas, 'idDependencias' => $model->idDependencias]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluacion-intermedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
