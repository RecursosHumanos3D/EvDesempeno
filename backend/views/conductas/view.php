<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Conductas */
?>
<div class="conductas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idConductas',
            'nombreConductas',
            'idCompetencia',
            'idNivel',
        ],
    ]) ?>

</div>
