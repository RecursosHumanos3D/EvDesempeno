<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EvaluacionIntermediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluacion Intermedia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-intermedia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Evaluacion Intermedia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idAutoNumerico',
            'idCompetencias',
            'idConductas',
            'idEvalVal',
            'idEtapas',
            // 'idDependencias',
            // 'comentario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
