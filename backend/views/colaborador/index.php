<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ColaboradorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colaboradores';
?>

<div id="master" class="colaborador-index">

    <main class="demo-main mdl-layout__content">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>

        <p>
            <?= Html::button('Crear un Colaborador', ['value' => Url::to('index.php?r=colaborador/create'), 'class' => 'btn btn-raised btn-success', 'id' => 'modalButton']) ?>    
        </p>

        <?php $this->params['breadcrumbs'][] = $this->title; ?>
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>

        <style>
            nav#w49 {
                margin-bottom: auto;
            }
            
            .demo-ribbon {
                width: 100%;
                height: 30vh;
                background-color: #009688;
                -webkit-flex-shrink: 0;
                -ms-flex-negative: 0;
                flex-shrink: 0;
            }

            .demo-main {
                margin-top: -35vh;
                -webkit-flex-shrink: 0;
                -ms-flex-negative: 0;
                flex-shrink: 0;
                background-color: #ffffff;
                border-radius: 2px;
                padding: 35px 56px;
            }

            .panel-footer {
                background-color: #fff;
                display: none;
            }

            .kv-expand-icon.kv-state-expanded {
                font-weight: 800;
                text-transform: uppercase;
                font-size: 10px;
                
            }
            .kv-expand-header-icon.kv-state-collapsed {
                font-weight: 800;
                text-transform: uppercase;
                font-size: 10px;
                color: aliceblue;
            }
            th.kv-align-center.kv-align-middle.skip-export.kv-expand-header-cell.kv-batch-toggle.kv-merged-header {
                background-color: rgba(0, 150, 136, 0.64);
            }

            td.skip-export.kv-align-center.kv-align-middle.kv-expand-icon-cell {
                background-color: #009688;
            }

          
        </style>
        <?php
        Modal::begin([
            'header' => '<h4>Colaborador</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>


        <?php Pjax::begin(); ?>    
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'autoXlFormat' => true,
            'export' => [
                'fontAwesome' => true,
                'showConfirmAlert' => false,
                'target' => GridView::TARGET_BLANK
            ], 'panel' => [
                'type' => 'primary',
                'heading' => 'Listado de colaboradores'
            ],
            'columns' => [

                [

                    'class' => 'kartik\grid\ExpandRowColumn',
                    'value' => function ($model, $key, $index, $column) {

                        return kartik\grid\GridView::ROW_COLLAPSED;
                    },
                    'detail' => function($model, $key, $index, $column) {
                        $searchModel = new app\models\DependenciasSearch();
                        $searchModel->Colaborador_rutColaborador = $model->rutColaborador;
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        return Yii::$app->controller->renderPartial('_dependencias', [
                                    'searchModel' => $searchModel,
                                    'dataProvider' => $dataProvider,
                        ]);
                    },
                        ],
                        'rutColaborador',
                        'nombreColaborador',
                        'apellidosColaborador',
                        'password',
//                        [
//                            'attribute' => 'rutEmpresa',
//                            'value' => 'rutEmpresa0.nombreEmpresa',
//                            'filter' => Html::activeDropDownList($searchModel, 'rutEmpresa', ArrayHelper::map(app\models\Empresas::find()->asArray()->all(), 'nombreEmpresa', 'nombreEmpresa'), ['class' => 'form-control', 'prompt' => 'Seleccione Empresa']),
//                        ],
                       
                        'rol.nombreRol',
                ]]);
                ?>
                <?php Pjax::end(); ?>







    </main>


</div>
