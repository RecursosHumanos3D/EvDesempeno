<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cargos */

$this->title = $model->idCargo;
$this->params['breadcrumbs'][] = ['label' => 'Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idCargo], ['class' => 'btn btn-raised btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idCargo], [
            'class' => 'btn btn-raised btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCargo',
            'nombreCargo',
        ],
    ]) ?>

</div>
