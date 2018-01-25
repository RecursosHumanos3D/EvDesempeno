<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EvaluacionIntermedia */

$this->title = 'Create Evaluacion Intermedia';
$this->params['breadcrumbs'][] = ['label' => 'Evaluacion Intermedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-intermedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
