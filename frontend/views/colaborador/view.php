<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Colaborador */

$this->title = $model->rutColaborador;
$this->params['breadcrumbs'][] = ['label' => 'Colaboradors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colaborador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'rutColaborador' => $model->rutColaborador, 'rutEmpresa' => $model->rutEmpresa, 'idCargo' => $model->idCargo, 'idRol' => $model->idRol, 'idArea' => $model->idArea], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'rutColaborador' => $model->rutColaborador, 'rutEmpresa' => $model->rutEmpresa, 'idCargo' => $model->idCargo, 'idRol' => $model->idRol, 'idArea' => $model->idArea], [
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
            'rutColaborador',
            'nombreColaborador',
            'apellidosColaborador',
            'rutEmpresa',
            'idCargo',
            'idRol',
            'email:email',
            'fechaIngreso',
            'idArea',
            'estado',
            'idNivel',
        ],
    ]) ?>

</div>
