<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        $model = Yii::$app->request->post();
        
        if (empty($model)) {
            $this->layout = 'loginLayout';
            return $this->render('login', [
                        'model' => $model,
            ]);
        } else {
             $model = $this->encuentraColaborador(Yii::$app->request->post()["user"]);
            if($model){
            $model = $this->encuentraColaborador(Yii::$app->request->post()["user"]);
            
            if ($model[0]["password"] == Yii::$app->request->post()["correo"]) {
                if (empty($model)) {
                    return $this->render('noEncontrado');
                } else {
                    $estado = $model[0]["estado"];
                   // var_dump($estado);die();
                    if($estado==null || $estado==1){
                    Yii::$app->response->redirect(array('navegacion/inicio', 'id' => $model[0]["rutColaborador"]));
                    }
                    
                    if($estado==2){

                        Yii::$app->response->redirect(array('navegacion/plan', 'rutEvaluador' => $model[0]["rutColaborador"]));
                    }
                    if($estado==3){
                        Yii::$app->response->redirect(array('navegacion/inicio', 'id' => $model[0]["rutColaborador"]));
                    }
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                }
            } else {
                return $this->render('noEncontrado');
            }
        }else{
            return $this->render('noEncontrado');
        }
        }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function encuentraColaborador($id) {
        if (($model = \app\models\Colaborador::find()->where(['email' => $id])->all()) !== null) {
            //var_dump($model);die();
            return $model;
        } else {

            $this->layout = 'main';
            return $this->render('noEncontrado');
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */


    public function actionReporteria() {

        $connection = Yii::$app->db;
        $sql = "evaluacion_intermedia e
                INNER JOIN dependencias d ON e.idDependencias = d.idDependencias
                INNER JOIN colaborador c ON d.Colaborador_rutColaborador = c.rutColaborador
                INNER JOIN colaborador ca ON d.Colaborador_rutColaborador1 = ca.rutColaborador
                INNER JOIN competencias co ON e.idCompetencias = co.idCompetencias
                WHERE e.idDependencias =2";

        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model = $dataReader->readAll();


        return $this->render('index', [
                    'model' => $model,
        ]);
    }

 

}
