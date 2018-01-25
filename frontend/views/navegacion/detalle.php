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
                    <h4 class="media-heading"><?php echo $model->nombreColaborador; ?><small> <?php echo $model->apellidosColaborador; ?></small></h4>
                    <h5><?php echo $model->gerenciaTexto; ?> <a href="http://gridle.in"></a></h5>
                    <hr style="margin:8px auto">

                      <span class="label label-default">Area</span>
                    <span class="label label-default"><?php echo $model->cargoTexto;?></span>
                    <span class="label label-default"><?php echo $model->gerenciaTexto;?></span>

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
                                    Accion
                                </th>
                             
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                            Ver Nota 
                            </td>
                              <td>
                            <?= Html::a('Ver Notas', ['/navegacion/resultadosu', 'id' => $dependencia], ['class' => 'btn btn-danger']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                           Formulario de Acuerdo
                            </td>
                              <td>
                            <?= Html::a('Descargar Acuerdo', ['/navegacion/descarga', 'id' => $dependencia], ['class' => 'btn btn-danger']); ?>
                            </td>
                        </tr>
                           <tr>
                            <td>
                            Acuerdo Subido
                            </td>
                              <td>

                           


                             <a class="btn btn-danger" href="<?php echo $acuerdo->ruta; ?>">Descargar Acuerdo Firmado</a> 

                            </td>
                        </tr>








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