<?php

namespace backend\controllers;

use Yii;
use app\models\Colaborador;
use app\models\ColaboradorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;

/**
 * ColaboradorController implements the CRUD actions for Colaborador model.
 */
class ColaboradorController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Colaborador models.
     * @return mixed
     */
    public function actionIndex() {
        ini_set('memory_limit', '8192M');
        $searchModel = new ColaboradorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Colaborador model.
     * @param integer $rutColaborador
     * @param integer $rutEmpresa
     * @param integer $idCargo
     * @param integer $idRol
     * @param integer $idArea
     * @return mixed
     */
    public function actionView($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea) {
        return $this->render('view', [
                    'model' => $this->findModel($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea),
        ]);
    }

    /**
     * Creates a new Colaborador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Colaborador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rutColaborador' => $model->rutColaborador, 'rutEmpresa' => $model->rutEmpresa, 'idCargo' => $model->idCargo, 'idRol' => $model->idRol, 'idArea' => $model->idArea]);
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Colaborador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $rutColaborador
     * @param integer $rutEmpresa
     * @param integer $idCargo
     * @param integer $idRol
     * @param integer $idArea
     * @return mixed
     */
    public function actionUpdate($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea) {
        $model = $this->findModel($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rutColaborador' => $model->rutColaborador, 'rutEmpresa' => $model->rutEmpresa, 'idCargo' => $model->idCargo, 'idRol' => $model->idRol, 'idArea' => $model->idArea]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    protected function findColaborador($id) {

        if (($model = Colaborador::findOne(['rutColaborador' => $id])) !== null) {


            return $model;
        } else {
            
        }
    }

    protected function findCargo($id) {
        if (($model = \app\models\Cargos::findOne($id)) !== null) {
            return $model->nombreCargo;
        } else {
            //  throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDescarga($id) {



        $temporal = $this->findDependenciaUnica($id);




        $model2 = $this->findColaborador($temporal->Colaborador_rutColaborador1);
        $objeto = new \yii\helpers\ArrayHelper();
        $objeto->rutColaborador = $model2->rutColaborador;
        $objeto->rutColaborador1 = $temporal->Colaborador_rutColaborador;
        $objeto->nombreColaborador = $model2->nombreColaborador;
        $objeto->apellidosColaborador = $model2->apellidosColaborador;
        $objeto->area = $this->findArea($model2->idArea);
        $objeto->cargo = $this->findCargo($model2->idCargo);
        $objeto->dependencia = $id;
        $objeto->idRol = $model2->idRol;
//        $plan = $this->findPlan($id);
//        $comentario = $this->findDependenciaUnica($id);
//        $objeto->comentario = $comentario->comentario;
//        $objeto->plan = $plan->textoUno;
//        $detalle = $this->findCalculador($id);
//        $total = 0;
//        $i = 0;
//
//        foreach ($detalle as $det) {
//            $total = $det["promedio"] + $total;
//            $i++;
//        }
//
//        $objeto->total = $total / $i;
        //   var_dump($model2);die();


        $connection = Yii::$app->db;
        $sql = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol = 17";


        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model = $dataReader->readAll();

        // var_dump($model2->idNivel);die();


        $connection = Yii::$app->db;
        $sql1 = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol =" . $id . "";


        $command1 = $connection->createCommand($sql1);
        $dataReader1 = $command1->query();
        $model1 = $dataReader1->readAll();






        $mpdf = new mPDF(
                '', // mode - default ''
                '', // format - A4, for example, default ''
                0, // font size - default 0
                '', // default font family
                16, // margin_left
                16, // margin right
                16, // margin top
                16, // margin bottom
                9, // margin header
                9, // margin footer
                'L');  // L - landscape, P - portrait
        $mpdf->WriteHTML($this->renderPartial('final', [

                    'transversal' => $model,
                    'especifica' => $model1,
                    'objeto' => $objeto,
                    'colaborador0' => $this->findColaborador($model2->rutColaborador),
                    'colaborador1' => $this->findColaborador($objeto->rutColaborador1),
        ]));
        $mpdf->Output('Acuerdo.pdf', 'D');
    }

    protected function findDependenciaUnica($id) {
        if (($model = \app\models\Dependencias::findOne(['idDependencias' => $id])) !== null) {
            return $model;
        } else {
            $resultado = \app\models\Dependencias::findOne(['Colaborador_rutColaborador' => $id]);
            return $resultado;
        }
    }

    /**
     * Deletes an existing Colaborador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $rutColaborador
     * @param integer $rutEmpresa
     * @param integer $idCargo
     * @param integer $idRol
     * @param integer $idArea
     * @return mixed
     */
    public function actionDelete($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea) {
        $this->findModel($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Colaborador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $rutColaborador
     * @param integer $rutEmpresa
     * @param integer $idCargo
     * @param integer $idRol
     * @param integer $idArea
     * @return Colaborador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rutColaborador) {
        if (($model = Colaborador::findOne(['rutColaborador' => $rutColaborador])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport() {
        $inputFile = 'uploads/colaborador.xlsx';


        $inputFiletype = \PHPExcel_IOFactory::identify($inputFile);
        $objReader = \PHPExcel_IOFactory::CreateReader($inputFiletype);
        $objPHPExcel = $objReader->load($inputFile);


        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $i = 1;
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        for ($row = 1; $row <= $highestRow; $row++) {




            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);



            $colaborador = new \app\models\Colaborador();

            $colaborador->rutColaborador = $rowData[0][0];
            $correo = $rowData[0][1];
            $cargo = $this->findCargos($rowData[0][1]);
            $area = $this->findArea($rowData[0][2]);
            $gerencia = $this->findGerencia($rowData[0][3]);
            $model = $this->updateColaborador($colaborador->rutColaborador, $correo);


            if ($area["idArea"] != NULL) {
                $colaborador->idArea = $area["idArea"];
            } else {
                $colaborador->idArea = 0;
            }

            if ($cargo["idCargo"] != NULL) {
                $colaborador->idCargo = $cargo["idCargo"];
            } else {
                $colaborador->idCargo = 0;
            }

            if ($gerencia["nombreGerencia"] != NULL) {
                $colaborador->idGerencia = $gerencia["idGerencia"];
            } else {
                $colaborador->idGerencia = 0;
            }

            $i++;

            try {

                $valid = $this->encuentraColaborador($colaborador->rutColaborador);
                if ($valid == true) {
                    
                } else {
                    $colaborador->save(false);
                }
            } catch (\Exception $e) {
                
            }
            ?><pre><?php
                print_r($colaborador->rutColaborador . "--------------->" . $colaborador->email);
                ?></pre><?php
        }
    }

    public function actionJuntar() {

        $model = \app\models\Dependencias::find()->all();

        ini_set('max_execution_time', 5000); //300 seconds = 5 minutes

        foreach ($model as $dependiente) {
            $model2 = \app\models\Colaborador::find()->where(['rutColaborador' => $dependiente->Colaborador_rutColaborador1])->all();




            $rol = $model2[0]["idNivel"];
            $nivel = $model2[0]["idNivel"];
            $rutColaborador = $dependiente->Colaborador_rutColaborador1;
            $dependencia = $dependiente->idDependencias;

            $model3 = \app\models\Competencias::find()->where(['idRol' => $rol])->all();




            foreach ($model3 as $m) {

                $competencia = $m["idCompetencias"];

                $model4 = \app\models\Conductas::find()->where([ 'idCompetencia' => $competencia, 'idNivel' => $nivel])->all();
                foreach ($model4 as $ma) {


                    $inserta = new \app\models\EvaluacionIntermedia();
                    $inserta->idCompetencias = $competencia;
                    $inserta->idConductas = $ma["idConductas"];
                    $inserta->valor = 0;
                    $inserta->idDependencias = $dependencia;



                    $inserta->save();
                }
            }
        }
    }

    protected function findCargos($id) {


        if (($model = \app\models\Cargos::find()->where(['nombreCargo' => $id])->one()) !== null) {

            if (empty($model)) {
                return 0;
            }
            return $model->idCargo;
        }
    }
    protected function updateColaborador($rutColaborador, $correo) {
            
            $model = $this->findColaborador($rutColaborador);
            $model->email = $correo;
            $model->save(false);
       
    }

    protected function findRoles($id) {


        if (($model = \app\models\Rol::find()->where(['nombreRol' => $id])->one()) !== null) {
            if (empty($model)) {
                return 0;
            }



            return $model;
        }
    }

    protected function findArea($id) {


        if (($model = \app\models\Area::find()->where(['nombreArea' => $id])->one()) !== null) {
            if (empty($model)) {
                return 0;
            }



            return $model->idArea;
        }
    }

    protected function findGerencia($id) {


        if (($model = \app\models\Gerencia::find()->where(['nombreGerencia' => $id])->one()) !== null) {
            if (empty($model)) {
                return 0;
            }


            return $model->idGerencia;
        }
    }

    protected function encuentraColaborador($rutColaborador) {
        if (($model = Colaborador::findOne(['rutColaborador' => $rutColaborador])) !== null) {
            return true;
        } else {

            return false;
        }
    }

    protected function encuentraColaborador2($rutColaborador) {
        if (($model = Colaborador::findOne(['rutColaborador' => $rutColaborador])) !== null) {
            return $model;
        } else {

            return false;
        }
    }

}
