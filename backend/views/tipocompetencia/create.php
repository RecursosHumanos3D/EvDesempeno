<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tipocompetencia */

$this->title = 'Create Tipocompetencia';
$this->params['breadcrumbs'][] = ['label' => 'Tipocompetencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipocompetencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
