<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'My Yii Application';
?>

<style>

    a#evaluacion {
        background-color: #ffffff !important;
        color: #583e7e !important;
    }

    small#evaluacion {
        background-color: #ffffff !important;
        color: #583e7e !important;
    }
    .panel-heading {
        background-color: #5bb632!important;
        border-color: #5bb632!important;
    }

    .panel.panel-primary {
        border-color: #5bb632!important;
    }
    a.pull-left {
        margin-bottom: -1px!important;
    }
</style>


<div class="container animated bounce">
    <div class="row">


        <div class="col-lg-12">
            <div class="media">

                <br>
                <br>
                <br>
                <div class="media-body animated rotateInUpRight">
                    <h4 style="    font-size: 44px;" class="media-heading "><?php echo $mandatorio[2]; ?><small> <?php echo $mandatorio[3]; ?></small></h4>
                    <h5 style="    font-size: 25px;"><?php echo $mandatorio[1]; ?> <a href="http://gridle.in"></a></h5>
                    <?= Html::a('Salir del sistema', ['/site/login'], ['class' => 'btn btn-danger jj']); ?>
                    <hr style="margin:8px auto">

                    <span class="label label-default">Area</span>
                    <span class="label label-default"><?php echo $mandatorio[0]; ?></span>
                    <span class="label label-default"><?php echo $mandatorio[1]; ?></span>
                    <br>
                    <br>



                </div>
            </div>

        </div>



    </div>
    <br>





    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">
                    <a data-toggle="collapse"
                       data-parent="#accordion"
                       href="#country">Personas a Evaluar</a>
                </h1>
            </div>
            <div id="country" class="panel-collapse collapse in">
                <div class="panel-body">




                    <table class="table table-condensed">
                        <thead>
                            <tr>

                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Cargo
                                </th>

                                <th>
                                    Estado 
                                </th>
                                <th>
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>




                            <?php
                            foreach ($secundarios as $a) {
                                //var_dump($a);die();
                                ?>

                                <tr>

                                    <td>
                                        <?php
                                        echo $a[0];
                                        echo "  ";
                                        echo $a[1];
                                        ?>
                                    </td>
                                    <td>
                                        <p style=" text-transform: uppercase;"><?php echo $a[7]; ?></p>
                                    </td>


                                    <td>

                                        <?php if ($a[4] == 0) { ?>
                                            <button class="btn btn-primary" type="button">
                                                No iniciado
                                            </button>

                                            <?php
                                        } else {

                                            if ($a[4] == 1) {
                                                ?>
                                                <button class="btn btn-primary" type="button">
                                                    Iniciado
                                                </button>

                                            <?php } else { ?>
                                                <?php if ($a[4] == 2) { ?>
                                                    <button class="btn btn-warning" type="button">
                                                      Pendiente a cerrar formulario
                                                    </button>

                                                    <?php
                                                } ?>
                                                 <?php if ($a[4] == 3) { ?>
                                                    <button class="btn btn-warning" type="button">
                                                    En plan de Accion
                                                    </button>

                                                    <?php
                                                } ?>
                                                 <?php if ($a[4] == 4) { ?>
                                                    <button class="btn btn-warning" type="button">
                                                        Proceso Finalizado
                                                    </button>

                                                    <?php
                                                }
                                             
                                            }
                                        }
                                        ?>


                                    </td>
                                    <td>

                                        <?php if ($a[4] == 0 || $a[4] == 1) { ?>
                                            <?= Html::a('Evaluar', ['/navegacion/evaluaciones', 'id' => $a[3], 'rol' => 17], ['class' => 'btn btn-danger']); ?>
                                            <?php
                                        } else {

                                            if ($a[4] == 2 || $a[4] == 3 || $a[4] == 4) {
                                                ?>
                                                <?= Html::a('Ver Nota', ['/navegacion/resultados', 'rutEvaluador' => $mandatorio[4]], ['class' => 'btn btn-danger']); ?>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>





                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>








</div>

