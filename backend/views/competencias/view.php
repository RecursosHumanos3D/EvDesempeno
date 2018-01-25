<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Competencias */
?>
<div class="competencias-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCompetencias',
            'nombreCompetencia',
            'descripcionCompetencia',
            'idRol',
        ],
    ]) ?>

</div>
