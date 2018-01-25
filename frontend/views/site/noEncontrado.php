<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'No encontrado';

?>
 <style>
        .form-group.field-djmanual-rutcolaborador {
            display: none;
        }

        .form-group.field-djmanual-estado {
            display: none;
        }
        .item {
            display: none;
        }

        ul.nav.nav-pills {
            display: none;
        }
    </style>
<h1>Usuario no encontrado en sistema.</h1>
<a class="btn btn-primary" href="javascript:history.back()"> Volver Atrás</a>