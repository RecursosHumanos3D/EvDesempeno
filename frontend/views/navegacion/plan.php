<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Cargos */
$randomKey = 0;
$this->title = 'Ingrese Plan de accion';
?>

<div class="cargos-create">


    <div class="container">
        <div class="row"><br />
            <div class="col-md-6">
                <link href='http://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>
                <style>

                    .cargos-create {
                        margin-top: 3%;
                    }
                    *{
                        font-family: 'Raleway', sans-serif;
                    }
                    a#plan {
                        background-color: #ffffff !important;
                        color: #583e7e !important;
                    }

                    small#plan {
                        background-color: #ffffff !important;
                        color: #583e7e !important;
                    }


                </style>


                <?php
                $rutUsuario;
                $numeroa = 0;
                foreach ($resultados as $r) {
                    ?>
                    <h1>Nombre Evaluado: <?php
                        echo $r->nombreEvaluado;
                        //$rutUsuario = $r->Evaluador;
                        //var_dump($r);die();
                        ?></h1>
                    <h2>Rut Evaluado: <?php echo $r->Evaluado; ?>-3</h2>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Competencia</th>
                                <th>Promedio</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($r->detalle as $model) {
                                //var_dump($model);die();
                                $numero = round($model["promedio"], 1, PHP_ROUND_HALF_DOWN);
                                ?>
                                <tr>
                                    <td><?php echo $model["nombreCompetencia"]; ?></td>
                                    <td><?php echo $numero; ?></td>


                                </tr>
                                <?php
                                $numeroa = $numero + $numeroa;
                                $i++;
                            }
                            ?>        
                        </tbody>
                    </table>
                    <p><button class="btn btn-success">Promedio de evaluación: <?php
                            if ($numeroa == 0) {
                                echo $numeroa;
                            } else {



                                $total = round($numeroa / $i, 1, PHP_ROUND_HALF_DOWN);
                                echo $total;
                            }
                            ?></button></p>

                    <br>
                <?php } ?>

















            </div>
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(); ?>

                <?=
                $form->field($plan, "idCompetencias")->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(app\models\Competencias::find()->where(['idRol' => $idRol])->all(), 'idCompetencias', 'nombreCompetencia'),
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccione la competencia ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <?= $form->field($plan, 'texto1')->textArea(['rows' => '3']) ?>
                <?= $form->field($plan, 'texto3')->textArea(['rows' => '3']) ?>
                <input type="hidden" name="idDependencia"  value="<?php echo $id; ?>"/>  

                <div class="form-group">
                    <?php
                    if ($busqueda==null) {
                        
                    } else {
                        echo Html::a('Finalizar Proceso', ['/navegacion/fin', 'id' => $id], ['class' => 'btn btn-danger']);
                    }
                    ?>
                    <?= Html::submitButton($plan->isNewRecord ? 'Ingrese un plan' : 'Update', ['class' => $plan->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end();
                ?>
            </div>
        </div>
        <div class="row">
            
            <?php if ($busqueda==null){
                
            }else{
                ?>
                    
                   <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'idPlanes',
                    'nombreCompetencia',
                    [
                    'value' => 'texto1',
                    'label' => 'Descripcion'
                    ],
                    [
                    'value' => 'texto3',
                    'label' => 'Acciones',
                    ],
                    [
                        'label' => 'Eliminar',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index) {
                            //var_dump($model);die();
                            return Html::a('Eliminar', ['delete', 'id' => $model["idPlanes"]], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Seguro que desea eliminar este plan de accion?',
                                            'method' => 'post',
                                        ],
                            ]);
                        },
                            ],
                        //'idPlanAccion',
                        ],
                    ]);
                    ?>  
                    
                    
                 <?php
            }
            ?>
            
            
            
            
           
        </div>




    </div>


</div>