<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DependenciasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<style>
    tbody tr:hover {
        background-color: #009688;
        color: black;
    }
    thead:hover {
        background-color: #ffffff;
        color: black;
    }

    thead, a:hover {
        color: #fbfbfb;
    }

</style>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showPageSummary' => true,
    'rowOptions' => function ($model) {
        if ($model->Colaborador_rutColaborador == $model->Colaborador_rutColaborador1) {
            return ['class' => 'danger'];
        } else {
            return ['class' => 'warning'];
        }
    },
            'columns' => [



                'colaborador1.nombreColaborador',
                'colaborador1.apellidosColaborador',
                'colaborador2.nombreColaborador',
                'colaborador2.apellidosColaborador',
                [
                    'attribute' => 'estado',
                    'value' => function ($model) {

                        if ($model->estado == 3) {
                            return '<span class="glyphicon glyphicon-certificate text-primary"></span>Finalizado';
                        }
                        if ($model->estado == 0) {
                            return '<span class="glyphicon glyphicon-certificate text-alert"></span>No Iniciado';
                        }
                        if ($model->estado == 1) {
                            return '<span class="glyphicon glyphicon-certificate text-warning"></span>En proceso';
                        }
                    },
                    'format' => 'html',
                ],
                             [
                                'format' => 'raw',
                                'label' => 'Finalizada?',
                                'value' => function ($model, $key, $index) {
                                    
                       return Html::a('Emitir Formulario', ['descarga', 'id' => $model->idDependencias], ['class' => 'btn btn-success']);
                                    
                                    
                                },
                                    ],
            ],
        ]);
        ?>

