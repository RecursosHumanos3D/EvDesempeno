<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">

    <div class="panel panel-primary">
        <div id="panels" class="panel-heading">
            <h3 style="text-align:center;" class="panel-title">
                Colaborador a evaluar</h3>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object dp" src="logo.png" style="      width: 80%;
                             height: 60%;
                             margin-top: 2px;
                             margin-left: 10px;
                             ">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $objeto->nombreColaborador; ?><small> <?php echo $objeto->apellidosColaborador; ?></small></h4>
                        <h5><?php //echo $objeto->cargo;      ?> <a href="http://gridle.in"></a></h5>
                        <hr style="margin:8px auto">

                        <span class="label label-default"><?php echo $objeto->cargoTexto;      ?></span>
                        <span class="label label-default"><?php echo $objeto->gerenciaTexto;      ?></span>

                    </div>
                </div>

            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th  WIDTH="30">Evaluacion</th>
                        <th WIDTH="30">Nota</th>
                        <th WIDTH="40">Descripcion</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>BAJO LO ESPERADO</td>
                        <td>1</td>
                        <td>No cumple o está lejos de cumplir  con las tareas y metas comprometidas. Despliega o realiza muy pocas veces la conducta o competencia evaluada.</td>
                    </tr>
                    <tr>
                        <td>PRÓXIMO A LO ESPERADO</td>
                        <td>2</td>
                        <td>Cumple parcialmente las tareas y metas comprometidas  no alcanzando el nivel esperado .La conducta o competencia evaluada se observa eventualmente.</td>
                    </tr>
                    <tr>
                        <td>DESEMPEÑO ESPERADO</td>
                        <td>3</td>
                        <td>Cumple  con las tareas y metas comprometidas. Desarrolla habitualmente la conducta o competencia evaluada. Este es un desempeño sólido, esperado de personas que tienen las experiencias y conocimientos necesarios para ejecutar las funciones de su puesto</td>
                    </tr>
                    <tr>
                        <td>SOBRE LO ESPERADO</td>
                        <td>4</td>
                        <td>Supera las  tareas y metas comprometidas alcanzando logros y rendimientos por sobre lo exigido en forma casi permanente.</td>
                    </tr>
                    <tr>
                        <td>EXCEPCIONAL</td>
                        <td>5</td>
                        <td>Supera ampliamente las tareas y metas comprometidas alcanzando logros y rendimientos de excepción.</td>
                    </tr>
                    <tr>
                        <td>NO APLICA</td>
                        <td>6</td>
                        <td>La conducta  descrita no es necesaria para el cargo.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</div>
<style type="text/css">
    

button.btn.btn-success.btn-block.ribbon {font-size: 35px;}

</style>
<button type="button" class="btn btn-success btn-block ribbon">
    COMPETENCIA TRANSVERSALES   
</button>
<br>
<?php
foreach ($competencias as $comp) {
    ?>



    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
            <br>
                    <br>
                <h2 style="text-transform:uppercase;">

                    <h3 style="text-transform:uppercase; text-align: center;    text-transform: uppercase;
    text-align: center;
    font-family: inherit;">COMPETENCIA <?php echo $comp->nombreCompetencia; ?>:</h3>

           
                     <p style="text-align: center;     text-align: center;
    width: 50%;
    width: 80%;
    margin: 0 auto;
    line-height: 25px;
    font-weight: 400;
    margin-top: 28px;
    letter-spacing: 1px;"><?php echo $comp->descripcionCompetencia; ?></p>
                     <br>
                    
                    
                    
                   
                </h2>
            </div>
        </div>
    </div>
    <?php
    $conductas = \app\models\Conductas::findAll(['idCompetencia' => $comp->idCompetencias, 'idNivel' => $nivel]);
    //var_dump($nivel);die();
    foreach ($conductas as $cond) {
        ?>
        <div class="panel panel-primary">
            <div id="Cabesera" class="panel-heading">
                <h3  class="panel-title"><?php echo $cond->nombreConductas; ?>:</h3>

            </div>
            <div class="container">

                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">


                            <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                <div class="checkbox">
                                    <label value="<?php echo $cond->idConductas; ?>" onclick='$.post("index.php?r=navegacion/actualizar&idA=<?php echo $comp->idCompetencias; ?>&idB=<?php echo $cond->idConductas; ?>&dependencia=<?php echo $dependencia; ?>&valor=1");'>
                                        <input class="jt" id="<?php echo $cond->idConductas; ?>" name="<?php echo $cond->idConductas; ?>" type="radio"  >
                                        1 BAJO LO ESPERADO
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                <div class="checkbox">
                                    <label value="<?php echo $cond->idConductas; ?>" onclick='$.post("index.php?r=navegacion/actualizar&idA=<?php echo $comp->idCompetencias; ?>&idB=<?php echo $cond->idConductas; ?>&dependencia=<?php echo $dependencia; ?>&valor=2");'>
                                        <input class="jt" id="<?php echo $cond->idConductas; ?>" name="<?php echo $cond->idConductas; ?>" type="radio" >
                                        2 PROXIMO A LO ESPERADO
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                <div class="checkbox">
                                    <label value="<?php echo $cond->idConductas; ?>" onclick='$.post("index.php?r=navegacion/actualizar&idA=<?php echo $comp->idCompetencias; ?>&idB=<?php echo $cond->idConductas; ?>&dependencia=<?php echo $dependencia; ?>&valor=3");'>
                                        <input class="jt" name="<?php echo $cond->idConductas; ?>" type="radio"  >
                                        3 DESEMPEÑO ESPERADO
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                <div class="checkbox">
                                    <label value="<?php echo $cond->idConductas; ?>" onclick='$.post("index.php?r=navegacion/actualizar&idA=<?php echo $comp->idCompetencias; ?>&idB=<?php echo $cond->idConductas; ?>&dependencia=<?php echo $dependencia; ?>&valor=4");'>
                                        <input class="jt" name="<?php echo $cond->idConductas; ?>" type="radio" >
                                        4 SOBRE LO ESPERADO
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                <div class="checkbox">
                                    <label value="<?php echo $cond->idConductas; ?>" onclick='$.post("index.php?r=navegacion/actualizar&idA=<?php echo $comp->idCompetencias; ?>&idB=<?php echo $cond->idConductas; ?>&dependencia=<?php echo $dependencia; ?>&valor=5");'>
                                        <input class="jt" name="<?php echo $cond->idConductas; ?>" type="radio" >
                                        5 EXCEPCIONAL
                                    </label>
                                </div>
                            </div>
                          

                        </div>
                    </div>
                </div>
            </div>


        </div>



        <?php
    }
}
?>
<a class="btn btn-danger" href="#" onclick="finalizaItem(<?php echo $dependencia; ?>);">Avanzar a competencias especificas</a>






<style>
    div#panels {
        background-color: #e31b1e!important;
        border-color: #e31b1e!important;
    }

    div#panels {
        border-color: #e31b1e!important;
    }
    a.pull-left {
        margin-bottom: -1px!important;
    }
</style>



