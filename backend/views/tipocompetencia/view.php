<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocompetencia */

$this->title = $model->idTipoCompetencia;
$this->params['breadcrumbs'][] = ['label' => 'Tipocompetencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipocompetencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idTipoCompetencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idTipoCompetencia], [
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
            'idTipoCompetencia',
            'nombreTipoCompetencia',
        ],
    ]) ?>

</div>
