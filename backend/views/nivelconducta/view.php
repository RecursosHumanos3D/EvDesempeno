<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nivelconducta */
?>
<div class="nivelconducta-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idNivel',
            'nombreNivel',
        ],
    ]) ?>

</div>
