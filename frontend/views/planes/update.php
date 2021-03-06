<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Planes */

$this->title = 'Update Planes: ' . $model->idPlanes;
$this->params['breadcrumbs'][] = ['label' => 'Planes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPlanes, 'url' => ['view', 'id' => $model->idPlanes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
