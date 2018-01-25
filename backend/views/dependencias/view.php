<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dependencias */

$this->title = $model->idDependencias;
$this->params['breadcrumbs'][] = ['label' => 'Dependencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependencias-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idDependencias' => $model->idDependencias, 'Colaborador_rutColaborador' => $model->Colaborador_rutColaborador, 'Colaborador_rutColaborador1' => $model->Colaborador_rutColaborador1], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idDependencias' => $model->idDependencias, 'Colaborador_rutColaborador' => $model->Colaborador_rutColaborador, 'Colaborador_rutColaborador1' => $model->Colaborador_rutColaborador1], [
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
            'idDependencias',
            'Colaborador_rutColaborador',
            'Colaborador_rutColaborador1',
            'estado',
        ],
    ]) ?>

</div>
