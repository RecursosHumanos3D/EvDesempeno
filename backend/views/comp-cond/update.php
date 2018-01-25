<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CompCond */

$this->title = 'Update Comp Cond: ' . $model->idComp_Cond;
$this->params['breadcrumbs'][] = ['label' => 'Comp Conds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idComp_Cond, 'url' => ['view', 'idComp_Cond' => $model->idComp_Cond, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comp-cond-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
