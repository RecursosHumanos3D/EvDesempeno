<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$session = Yii::$app->session;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>

        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>EVALUACIÓN DEL DESEMPEÑO HORTIFRUT</title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <nav class="navbar navbar-menu" role="navigation">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <img style="width: 100%;" src="banner.png">

    <div class="navbar-main-container animate bounceInDown">
        <ul class="nav navbar-nav navbar-main" id="main-nav">
            <li id="evaluacion" class="navbar-item">
                <a id="evaluacion" href="index.php?r=navegacion/inicio&id=<?php echo $session->get('rut'); ?>">
                    <span class="icon-arrow-right">Evaluacion<br/>
                        <small id="evaluacion">Paso 1</small>
                    </span>
                </a>
            </li>
            <li id="feedback" class="navbar-item">
                <a id="feedback" href="index.php?r=navegacion/resultados&rutEvaluador=<?php echo $session->get('rut'); ?>">
                    <span class="icon-arrow-right">Feedback<br/>
                        <small id="feedback">Paso 2</small>
                    </span></a>
            </li>
            <li id="plan" class="navbar-item">
                <a id="plan" href="index.php?r=navegacion/planmenu2&id=<?php echo $session->get('rut'); ?>">
                    <span class="icon-arrow-right">Plan de Accion<br/>
                        <small id="plan">Paso 3</small>
                    </span>
                </a>
            </li>
            <li class="navbar-item"><a href="index.php?r=navegacion/fin2&id=<?php echo $session->get('rut'); ?>"><span class="icon-arrow-right">Finaliza<br/><small>Paso 5</small></span></a></li>
        </ul>
    </div>
</nav>
       
        <div class="wrap">
            


            <div class="container">

                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Desarrollado por RRHH3d <?= date('Y') ?></p>

                <p class="pull-right">Laboratorios Biosano 2017</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
