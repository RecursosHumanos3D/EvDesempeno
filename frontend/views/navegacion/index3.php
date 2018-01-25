<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'My Yii Application';
$global;
?>




<div class="container">
    <div class="row">


        <div class="col-lg-12">
            <div class="media">
               <a class="pull-left" href="#">
                    <img class="media-object dp" src="logo.png" style="width: 100%;height:100%;">
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
                    <br>
                                                         <?= Html::a('Salir del sistema', ['/site/login'], ['class' => 'btn btn-danger']); ?>

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
                                    Descarga
                                </th>

                                <th>
                                    Estado
                                </th>
                                <th>
                                    Formulario Vacio
                                </th>
                            </tr>
                        </thead>
                        <tbody>




                            <?php
                            foreach ($secundarios as $a) {
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
                                        <?php echo $a[8]; ?>
                                    </td>
                                    <td>
                                        <?php echo $a[9]; ?>
                                    </td>
                                    
                                    <td>

                                    <?php
                                        if ($a[6] == 4) {

                                         ?>
                                           

                                        <?php }else
                                        { ?>
                                             <?= Html::a('Descargar Acuerdo', ['/navegacion/descarga', 'id' => $a[5]], ['class' => 'btn btn-danger']); ?>
                                             <?php
                                        }
                                        ?>


                                    </td>


                                    <td>

                                        <?php if ($a[6] == 3) { ?>
                                            <?= Html::a('Subir Acuerdo', ['/navegacion/acuerdo', 'id' => $a[5]], ['class' => 'btn btn-danger']); ?>
                                        <?php } else {
                                        		if ($a[6] == 4) {

                                         ?>
                                            <?= Html::a('Proceso Finalizado', ['/navegacion/acuerdo', 'id' => $a[5]], ['class' => 'btn btn-warning disabled']); ?>

                                        <?php } }?>
                                    </td>
                                    <td>
                                       <?php 
                                        if ($a[6] == 4) {

                                         ?>
                                           

                                        <?php }else
                                        { ?>
                                     <?= Html::a('Formulario', ['/navegacion/descargau', 'id' => $a[5]], ['class' => 'btn btn-danger']); ?>
                                             <?php
                                        }
                                        ?>




                                    </td>
                                </tr>


                                <?php
                               
                                if ($a[6] >= 3 ) {
                                    $global = 1;
                                } else {
                                    $global = 0;
                                }
                                ?>


                            <?php } ?>





                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <?php
    
       // echo Html::a('Avanzar', ['/navegacion/acuerdo', 'id' => $a[7]], ['class' => 'btn btn-danger']);
    
    ?>






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