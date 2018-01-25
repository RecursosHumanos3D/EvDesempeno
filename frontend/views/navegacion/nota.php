<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>

<script
  src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"
  crossorigin="anonymous"></script>

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <script
  src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"
  crossorigin="anonymous"></script>
   <script
  src="https://code.jquery.com/jquery-1.12.4.js"
  crossorigin="anonymous"></script>



  <script type="text/javascript">
      $( document ).ready(function() {
    sortTable(1);
    sortTable(1);
});
  </script>
<div class="container">
    <div class="row">
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
        <br />
        <div class="col-md-6">
            <link href='http://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>
            <style>


                *{
                    font-family: 'Raleway', sans-serif;
                }


            </style>










            <table id="myTable2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>

                        <th  onclick="sortTable(0)">
                            Nombre Evaluado
                        </th>

                        <th onclick="sortTable(1)">
                            Nota
                        </th>
                        <th>
                            Ver Detalle 
                        </th>

                        <th>
                            Avance
                        </th>

                    </tr>
                </thead>
                <tbody>




                    <?php
                    foreach ($resultados as $a) {
                        ?>

                        <tr>

                            <td>

                                <p style=" text-transform: uppercase;"> <?php echo $a->nombreEvaluado; ?></p>

                            </td>

                            <td>
                                <p style=" text-transform: uppercase;">

                                    <?php
                                    $i = 0;
                                    $promedio = 0;
                                    
                                    foreach ($a->detalle as $model) {
                                        $numero = + round($model["promedio"], 1, PHP_ROUND_HALF_DOWN);
                                        $i++;
                                        $promedio = $promedio + $numero;
                                    }
                                    ?>        
                                    <?php
                                    if ($promedio == 0) {
                                        echo $promedio;
                                    } else {
                                        $total = round($promedio / $i, 1, PHP_ROUND_HALF_DOWN);
                                        echo $total;
                                    }
                                    ?>
                                </p>
                            </td>

                            <td>

                                <?php if ($promedio == 0) { ?>
                                    <button class="btn btn-primary">Evaluación no iniciada</button>
                                <?php } else { ?>


                                    <?php if ($a->estado >= 3) {
                                        ?>
                                        <?= Html::a('Ver Nota', ['/navegacion/resultadosu', 'id' => $a->dependencia], ['class' => 'btn btn-danger']); ?>

                                    <?php }
                                    ?>


                                    <?php if ($a->estado == 1 || $a->estado == 3|| $a->estado == 4) {
                                        ?>

                                        <?php
                                    } else {
                                        ?>
                                        <?= Html::a('Ver Nota', ['/navegacion/resultadosu', 'id' => $a->dependencia], ['class' => 'btn btn-danger']); ?>

                                    <?php }
                                    ?>




                                <?php } ?>
                            <td>
                                <?php if ($a->estado == 2) {
                                    ?>
                                    <?= Html::a('Editar Evaluacion', ['/navegacion/evaluacion', 'id' => $a->dependencia, 'rol' => $a->idRol], ['class' => 'btn btn-danger']); ?>

                                    <?php }else{}
                                ?>
                            </td>      
                            </td>
                            <td>
                              
                                <?php if ($a->estado == 2) {
                                    ?>
                                    <?php echo Html::a('Finalizar evaluacion y avanzar a plan de accion', ['/navegacion/planmenu', 'id' =>  $a->dependencia], ['class' => 'btn btn-danger']); ?>

                                <?php } ?>
                            </td>

                        </tr>
                    <?php } ?>





                </tbody>
            </table>









        </div>
    </div>
</div>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

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

