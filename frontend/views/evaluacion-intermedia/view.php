<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EvaluacionIntermedia */

$this->title = $model->idAutoNumerico;
$this->params['breadcrumbs'][] = ['label' => 'Evaluacion Intermedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-intermedia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idAutoNumerico' => $model->idAutoNumerico, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas, 'idEvalVal' => $model->idEvalVal, 'idEtapas' => $model->idEtapas, 'idDependencias' => $model->idDependencias], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idAutoNumerico' => $model->idAutoNumerico, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas, 'idEvalVal' => $model->idEvalVal, 'idEtapas' => $model->idEtapas, 'idDependencias' => $model->idDependencias], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAutoNumerico',
            'idCompetencias',
            'idConductas',
            'idEvalVal',
            'idEtapas',
            'idDependencias',
            'comentario',
        ],
    ]) ?>

</div>
