<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlanesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Planes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPlanes',
            'texto1',
            'texto2',
            'texto3',
            'idPlanAccion',
            // 'idCompetencias',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
