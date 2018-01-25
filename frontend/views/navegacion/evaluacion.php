<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="container bg_valores">
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
                            <h5><?php echo $objeto->cargo; ?> <a href="http://gridle.in"></a></h5>
                            <hr style="margin:8px auto">

                            <span class="label label-default"><?php echo $objeto->area; ?></span>
                            <span class="label label-default">Gerencias</span>

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




    <?php
    $global;
    $rol = 0;
    $nombre = "";
    foreach ($model as $m) {
        if ($rol == 0) {
            ?>
            <!-- Standard button -->
            <button type="button" class="btn btn-success btn-block ribbon">
                COMPETENCIA <?php echo $m["nombreRol"]; ?>    
            </button>
            <br>

            <?php
            $rol = 1;
        }
        ?>

        <div class="row">
            <div class="col-md-12">

                <?php
                if ($m["nombreCompetencia"] != $nombre) {
                    ?>
                    <div class="panel-heading">
                        <h2 style="text-transform:uppercase;">

                            COMPETENCIA <?php echo $m["nombreCompetencia"]; ?>  :

                        </h2>
                    </div>
                    
                  <p><?php echo $m["descripcionCompetencia"]; ?></p>   
                    <?php
                    $nombre = $m["nombreCompetencia"];
                    $idRol = $m["idRol"];
                }
                ?>



                <div class="panel panel-primary">
                    <div id="Cabesera" class="panel-heading">
                        <h3  class="panel-title">
                            <?php echo $m["nombreConductas"]; ?>:</h3>

                    </div>

                    <div class="panel-body">
                        <div class="media">

                            <div class="media-body">




                                <div class="container">

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 1) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1-1" type="radio" checked="true" >
                                                    1 BAJO LO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" disabled>
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" disabled>
                                                    1 BAJO LO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 2) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" checked="true" >
                                                    2 PROXIMO A LO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" disabled>
                                                    2 PROXIMO A LO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 3) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" checked="true">
                                                    3 DESEMPEÑO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" disabled>
                                                    <input class="jt"  type="radio" disabled>
                                                    3 DESEMPEÑO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 4) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" checked="true">
                                                    4 SOBRE LO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" disabled>
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" disabled>
                                                    4 SOBRE LO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 5) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt"  name="<?php echo $m["idAutonumerico"]; ?>-1" type="radio" checked="true">
                                                    5 EXCEPCIONAL
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" disabled>
                                                    <input class="jt"  type="radio" disabled>
                                                    5 EXCEPCIONAL
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                  




                                </div>

                            </div>
                        </div>
                    </div>

                     <div class="panel-body">
                       <h3 style="text-align: center;">Selecciona el nuevo valor que consideres:</h3>
                        <div class="media">

                            <div class="media-body">




                                <div class="container">

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 1) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" id="<?php echo $m["idAutonumerico"]; ?>" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" checked="true" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=1");'>
                                                    1 BAJO LO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" id="<?php echo $m["idAutonumerico"]; ?>" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=1");'>
                                                    1 BAJO LO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 2) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" id="<?php echo $m["idAutonumerico"]; ?>" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" checked="true" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=2");'>
                                                    2 PROXIMO A LO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" id="<?php echo $m["idAutonumerico"]; ?>" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=2");'>
                                                    2 PROXIMO A LO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 3) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" checked="true" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=3").done(function(msg){   }).fail(function(xhr, status, error) {alert("Revise su Conexion a internet, no se ha guardado el cambio");});'>
                                                    3 DESEMPEÑO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=3");'>
                                                    3 DESEMPEÑO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 4) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" checked="true" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=4");'>
                                                    4 SOBRE LO ESPERADO
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=4");'>
                                                    4 SOBRE LO ESPERADO
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-lg-2">
                                        <?php if ($m["valor"] == 5) { ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" checked="true" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=5");'>
                                                    5 EXCEPCIONAL
                                                </label>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="checkbox">
                                                <label value="<?php echo $m["idAutonumerico"]; ?>" >
                                                    <input class="jt" name="<?php echo $m["idAutonumerico"]; ?>" type="radio" onclick='$.post("index.php?r=navegacion/actualiza&id=<?php echo $m["idAutonumerico"]; ?>&idV=5");'>
                                                    5 EXCEPCIONAL
                                                </label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                   




                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>











        </div>
        <hr>
    <?php }
    ?>
    <style>


        #nombreC{
            font-family: Verdana, Geneva, sans-serif;
            font-size: 16px;
        }
        .container {
            margin-top: 25px;
        }
        .form-inline .form-group > div.col-xs-8 {
            padding-left: 0;
            padding-right: 0;
        }
        .form-inline label {
            line-height: 34px;
        }
        .form-inline .form-control {
            width: 100%;
        }
        @media (min-width: 768px) {
            .form-inline .form-group {
                margin-bottom: 15px;
            }
        }

        .panel-body:not(.two-col) { padding:0px }
        .glyphicon { margin-right:5px; }
        .glyphicon-new-window { margin-left:5px; }
        .panel-body .radio,.panel-body .checkbox {margin-top: 0px;margin-bottom: 0px;}
        .panel-body .list-group {margin-bottom: 0;}
        .margin-bottom-none { margin-bottom: 0; }
        .panel-body .radio label,.panel-body .checkbox label { display:block; }
        h4.media-heading {
            margin-top: 18px;
        }
        div#Cabesera {
            background-color: #5cb85c!important;
            color: white;
        }

        /*Remove that CSS*/
        .col-md-3 {
            margin-left:5%;
        }
        /*Remove that CSS*/



        button {
            margin: 20px 0;
            line-height: 34px;
            position: relative;
            cursor: pointer;
            user-select: none;
            outline:none !important;
            width:100%;
        }

        button:active {

            outline:none;
        }

        button.ribbon {

            outline:none;
            outline-color: transparent;
        }
        button.ribbon:before, button.ribbon:after {
            top: 5px;
            z-index: -10;
        }
        button.ribbon:before {
            border-color: #53dab6 #53dab6 #53dab6 transparent;
            left: -25px;
            border-width: 17px;
        }
        button.ribbon:after {
            border-color: #53dab6 transparent #53dab6 #53dab6;
            right: -25px;
            border-width: 17px;
        }

        button:before, button:after {
            content: '';
            position: absolute;
            height: 0;
            width: 0;
            border-style: solid;
            border-width: 0;
            outline:none;
        }

        button.btn-default:before {
            border-color: #757575 #757575 #757575 transparent;
        }
        button.btn-default:after {
            border-color: #757575 transparent #757575 #757575;
        }



        button.btn-primary:before {
            border-color: #2e6da4 #2e6da4 #2e6da4 transparent;
        }
        button.btn-primary:after {
            border-color: #2e6da4 transparent #2e6da4 #2e6da4;
        }


        button.btn-success:before {
            border-color: #398439 #398439 #398439 transparent;
        }
        button.btn-success:after {
            border-color: #398439 transparent #398439 #398439;
        }


        button.btn-info:before {
            border-color: #269abc #269abc #269abc transparent;
        }
        button.btn-info:after {
            border-color: #269abc transparent #269abc #269abc;
        }


        button.btn-warning:before {
            border-color: #d58512 #d58512 #d58512 transparent;
        }
        button.btn-warning:after {
            border-color: #d58512 transparent #d58512 #d58512;
        }


        button.btn-danger:before {
            border-color: #ac2925 #ac2925 #ac2925 transparent;
        }
        button.btn-danger:after {
            border-color: #ac2925 transparent #ac2925 #ac2925;
        }

        button.btn.btn-success.btn-block.ribbon {
            TEXT-TRANSFORM: uppercase;
            font-size: 30px;
        }

    </style>

    <?php if ($idRol != 17) { ?>
        <?php $form = ActiveForm::begin(['action' => ['navegacion/finalizador'], 'options' => ['method' => 'get']]) ?>
        <label>Comentario:</label>
        <input id="comentarios" type="text" name="comentario">
        <input type="hidden" name="id" value="<?php echo $objeto->dependencia; ?>">
        <br>
        <?= Html::submitButton('finalizar', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
        
        <br>
        
    <?php } else { ?>
        <?= Html::a('Siguiente', ['/navegacion/evaluacion', 'id' => $objeto->dependencia, 'rol' => $objeto->idRol], ['class' => 'btn btn-success']); ?>
    <?php } ?>
</div>
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
<style>

input#comentarios {
    width: 100%;
}
div#panels {
background-color: #5bb632!important;
border-color: #e31b1e!important;
}

div#panels {
border-color: #5bb632!important;
}
a.pull-left {
margin-bottom: -1px!important;
}
button.btn.btn-primary {
    width: 25%;
}
</style>