<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>

<div class="container">
    <div class="row"><br />
        <div class="col-md-6">
            <link href='http://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>
            <style>


                *{
                    font-family: 'Raleway', sans-serif;
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
                <?php if ($r->estado == 3 || $r->estado == 0 || $r->estado == 4) {
                    ?>
                <?php } else { ?>
                    <?= Html::a('Finalizar evaluacion y avanzar a plan de accion.', ['plan', 'id' => $dependencia], ['class' => 'btn btn-raised btn-primary btn-lg']) ?>
                <?php } ?>
               
               
            <?php } ?>

















        </div>
    </div>
</div>
<p>



</p>
<style>

    a#feedback {
        background-color: #ffffff !important;
        color: #583e7e !important;
    }

    small#feedback {
        background-color: #ffffff !important;
        color: #583e7e !important;
    }

    .one, .two, .three{
        position:absolute;
        margin-top:-10px;
        z-index:1;
        height:40px;
        width:40px;
        border-radius:25px;

    }
    .one{
        left:25%;
    }
    .two{
        left:50%;
    }
    .three{
        left:0%;
    }
    .primary-color{
        background-color:#4989bd;
    }
    .success-color{
        background-color:#5cb85c;
    }
    .danger-color{
        background-color:#d9534f;
    }
    .warning-color{
        background-color:#f0ad4e;
    }
    .info-color{
        background-color:#5bc0de;
    }
    .no-color{
        background-color:inherit;
    }

</style>

