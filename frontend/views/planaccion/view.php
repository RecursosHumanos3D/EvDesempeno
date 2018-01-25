<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Planaccion */
?>
<div class="planaccion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPlanAccion',
            'textoUno',
            'textoDos',
            'idEtapas',
        ],
    ]) ?>

</div>
