<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CompCond */

$this->title = 'Create Comp Cond';
$this->params['breadcrumbs'][] = ['label' => 'Comp Conds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comp-cond-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
