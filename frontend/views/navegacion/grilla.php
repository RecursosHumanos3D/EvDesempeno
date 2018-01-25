<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'My Yii Application';
?>




<div class="container animated bounce">
    <div class="row">


        <div class="col-lg-12">
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object dp animated  bounce" src="logo.png" style="width: 100%;height:100%;">
                </a>
                <br>
                <br>
                <br>
                <br>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $mandatorio[2]; ?><small> <?php echo $mandatorio[3]; ?></small></h4>
                    <h5><?php echo $mandatorio[1]; ?> <a href="http://gridle.in"></a></h5>
                    <hr style="margin:8px auto">

                      <span class="label label-default">Area</span>
                    <span class="label label-default"><?php echo $mandatorio[8];?></span>
                    <span class="label label-default"><?php echo $mandatorio[7];?></span>
                    
                      <br>
                    <br>
                    <div class="col-lg-6">
                 <?= Html::a('Cambiar contraseña', ['/colaborador/update', 'rutColaborador' => $mandatorio[4]], ['class' => 'btn btn-danger']); ?>
                    </div>
                     <div class="col-lg-6">
                                        <a class="btn btn-danger" href="manual.pdf">Descargar manual del sistema.</a>

                    </div>
                     <br>
                 <br>

                     <div class="col-lg-6">
                 <?= Html::a('Salir del sistema', ['/site/login'], ['class' => 'btn btn-danger']); ?>
                    </div>
                     <div class="col-lg-6">

                    </div>
                    <br>

                </div>
            </div>

        </div>



    </div>





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
                                    Area
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
                                        <p style=" text-transform: uppercase;"><?php echo $a[8]; ?></p>
                                    </td>
                                    <td>
                                        <p style=" text-transform: uppercase;"><?php echo $a[9]; ?></p>
                                    </td>

                                    <td>

                                        <?php if ($a[6] == 0) { ?>
                                            <button class="btn btn-primary" type="button">
                                                No iniciado
                                            </button>

                                            <?php
                                        } else {

                                            if ($a[6] == 1) {
                                                ?>
                                                <button class="btn btn-primary" type="button">
                                                    Iniciado
                                                </button>

                                            <?php } else { ?>
                                                <?php if ($a[6] == 2 || $a[6] == 3 || $a[6] == 4) { ?>
                                                    <button class="btn btn-warning" type="button">
                                                        Finalizado
                                                    </button>

                                                    <?php
                                                }
                                            }
                                        }
                                        ?>


                                    </td>
                                    <td>
                                            
                                        <?php  if ($a[6] == 0 || $a[6] == 1) { ?>
                                            <?= Html::a('Evaluar', ['/navegacion/evaluacionest', 'id' => $a[5], 'rol' => 17], ['class' => 'btn btn-danger']); ?>
                                        <?php } else { 
                                            if($a[6] == 2 || $a[6] == 3 || $a[6] == 4){?>
                                            <?= Html::a('Ver Nota', ['/navegacion/resultadosu', 'id' => $a[5]], ['class' => 'btn btn-danger']); ?>

                                        <?php } }?>
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

<style>
    .panel-heading {
        background-color: #e31b1e!important;
        border-color: #e31b1e!important;
    }

    .panel.panel-primary {
        border-color: #e31b1e!important;
    }
    a.pull-left {
    margin-bottom: -1px!important;
}
</style>