<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DependenciasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dependencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependencias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
<?php Pjax::begin(); ?>   

 <?= GridView::widget([
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
                'label' => 'estado',
                'format' => 'raw',
                'filter' => Html::dropDownList(['1' => 'Yes', '0' => 'No'],['prompt'=>'Select Option']),
                'value' => function ($model, $key, $index) {
                        
                        if($model->estado==0){
                            return "No Iniciado";

                        }
                        if($model->estado==1){
                            return "Evaluacion Iniciada";
                        }
                        if($model->estado==2){
                            return "En Formulario";
                        }
                        if($model->estado==3){
                            return "En Plan de Accion";

                        }
                        if($model->estado==4){
                            return "Proceso finalizado";
                        }





                },
                    ],

            
                    [
                'label' => 'Evaluador',
                'attribute' => 'Colaborador_rutColaborador',
                'value' => 'Colaborador_rutColaborador',
            ],
            [
                'attribute' => 'colaborador1.nombreColaborador',
                'value' => 'colaborador1.nombreColaborador',
            ],
            [
                'attribute' => 'colaborador1.apellidosColaborador',
                'value' => 'colaborador1.apellidosColaborador',
            ],
               [
                'label' => 'relacion',
                'format' => 'raw',
                'value' => function ($model, $key, $index) {
                 return '---->';
                },
                    ],
                    [
                'label' => 'Evaluado',
                'attribute' => 'Colaborador_rutColaborador1',
                'value' => 'Colaborador_rutColaborador1',
            ],

            [
                'attribute' => 'colaborador2.nombreColaborador',
                'value' => 'colaborador2.nombreColaborador',
            ],
            [
                'attribute' => 'colaborador2.apellidosColaborador',
                'value' => 'colaborador2.apellidosColaborador',
            ],
           

            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
