<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <style>
        img.img-responsive {
            margin: 0px auto;
        }
        #textoSuperior{
            color: black!Important;
            font-size: 25px;
        }
    </style>



    <div class="content animated infinite bounce">
        
        <?= Html::img('@web/cliente_biosano.png', ['alt' => '', 'class' => 'img-responsive']); ?>
        <div id="textoSuperior"class="title animated infinite bounce">Sistema Evaluacion Desempeño</div>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-signin']); ?>
        <br>

        <div class="col-xs-12">
        <p style="color: black;    text-align: center;" for="correo">Ingrese su correo corporativo</p>
        <input  type="text" class="form-control" placeholder="Ingrese su correo" name="user" id="user" required="true" autofocus="true">
        </div>    
        

        <div class="col-xs-12">
        <p style="color: black;     text-align: center;">Ingrese su rut SIN DIGITO VERIFICADOR</p>
        <input style="color:black;" onkeypress="return justNumbers(event);" name="correo" type="password" required="true" placeholder="Ingrese su rut sin digito verificador"/>
        </div>
        <button>Ingresar</button>

        <?php ActiveForm::end(); ?>
        <div class="social"> <span>Recursos Humamos 3D</span></div>

    </div>



</div>
<script>
function justNumbers(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == "."))
        return true;

    return /\d/.test(String.fromCharCode(keynum));
}
</script>