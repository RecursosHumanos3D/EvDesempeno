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
                                    Accion
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
                                        <?php echo $a[7]; ?>
                                    </td>



                                    <td>

                                        <?php if ($a[4] == 4) { ?>
                                            <?= Html::a('Proceso Finalizado', ['/navegacion/acuerdo', 'id' => $a[7]], ['class' => 'btn btn-danger disabled']); ?>
                                        <?php } else { ?>
                                            <?= Html::a('Proceso Pendiente', ['/navegacion/acuerdo', 'id' => $a[7]], ['class' => 'btn btn-primary disabled']); ?>

                                        <?php } ?>
                                    </td>
                             
                                </tr>


                                <?php
                                if ($a[6] == 4) {
                                    $global = 0;
                                } else {
                                    $global = 1;
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
if ($global == 1) {
    // echo  Html::a('Avanzar', ['/navegacion/acuerdo', 'id' => $a[7], 'upgrade' => 1], ['class' => 'btn btn-danger']);
} else {
    echo "ha finalizado el proceso.";
}
?>






</div>

<style>
    .panel-heading {
        background-color: #5bb632!important;
        border-color: #e31b1e!important;
    }

    .panel.panel-primary {
        border-color: #5bb632!important;
    }
    a.pull-left {
        margin-bottom: -1px!important;
    }
</style>