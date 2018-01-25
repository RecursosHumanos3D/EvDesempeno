<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rols';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::button('Crear un Rol', ['value' => Url::to('index.php?r=rol/create'), 'class' => 'btn btn-raised btn-success', 'id' => 'modalButton']) ?>    

    </p>



    <?php Pjax::begin(); ?>    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'nombreRol',
                'width' => '250px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model->nombreRol;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Rol::find()->orderBy('nombreRol')->asArray()->all(), 'idRol', 'nombreRol'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any category'],
                'group' => true, // enable grouping
            ],
             [
                'attribute' => 'idRol',
                'width' => '250px',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a('Descargar Formulario', ['descargau', 'id' => $model->idRol], ['class' => 'btn btn-primary', 'target'=>'_blank']);

                },
               
            ],
            
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
