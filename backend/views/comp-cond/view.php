<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CompCond */

$this->title = $model->idComp_Cond;
$this->params['breadcrumbs'][] = ['label' => 'Comp Conds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comp-cond-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idComp_Cond' => $model->idComp_Cond, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idComp_Cond' => $model->idComp_Cond, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas], [
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
            'idComp_Cond',
            'idCompetencias',
            'idConductas',
        ],
    ]) ?>

</div>
