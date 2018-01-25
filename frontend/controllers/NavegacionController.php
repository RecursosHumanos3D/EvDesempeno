<?php

namespace frontend\controllers;

use Yii;
use app\models\Colaborador;
use app\models\Dependencias;
use app\models\Planaccion;
use app\models\Acuerdo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use mPDF;

/**
 * ColaboradorController implements the CRUD actions for Colaborador model.
 */
class NavegacionController extends Controller {

    public function actionDetalle($id, $dependencia) {

        $model = $this->findColaborador($id);
        $acuerdo = $this->findAcuerdo($dependencia);


        return $this->render('detalle', [
                    'model' => $model,
                    'acuerdo' => $acuerdo,
                    'dependencia' => $dependencia,
        ]);
    }

    public function actionEvaluaciones($id) {

        $dependencia = $this->findDependenciaUnica($id);
        $colaborador = $this->findColaborador($dependencia->Colaborador_rutColaborador1);
//                  var_dump($colaborador->idRol);die();

        $competencias = $this->findCompetencias($colaborador->idRol);







        return $this->render('evaluaciones', [
                    'objeto' => $colaborador,
                    'competencias' => $competencias,
                    'dependencia' => $id,
                    'rol' => $colaborador->idRol,
        ]);
    }

    public function actionEvaluacionest($id) {
        //  var_dump($id);die();
        $dependencia = $this->findDependenciaUnica($id);
        //var_dump($dependencia);die();
        $colaborador = $this->findColaborador($dependencia->Colaborador_rutColaborador1);

        $competencias = $this->findCompetenciast();
        $connection = Yii::$app->db;




        //var_dump($colaborador->idNivel);die();

        return $this->render('evaluacionest', [
                    'objeto' => $colaborador,
                    'competencias' => $competencias,
                    'dependencia' => $id,
                    'nivel' => $colaborador->idNivel,
                    'rol' => $colaborador->idRol,
        ]);
    }

    // INICIO DE METODOS DE MENU el $id es el rut del evaluador

    public function actionInicio($id) {

        $mandatorio = [];
        $model = $this->findDependencia($id);

        if ($model == null) {
            return $this->render("noEncontrado");
        }


        $objeto = $this->findColaborador($id);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;
        //var_dump($mandatorio);die();

        $session = Yii::$app->session;
        $session->set('rut', $objeto->rutColaborador);
        $session->open();

        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);
        $i = 0;
        foreach ($secundarios as $s) {

            // var_dump($s);die();
            if ($s[4] != 2) {
                $i = 1;
            }
        }

        if ($i == 0) {
            return $this->render('index1', [
                        'mandatorio' => $mandatorio,
                        'secundarios' => $secundarios,
            ]);
        }

        return $this->render('index', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }

    public function actionIniciop($id) {
        $mandatorio = [];
        $model = $this->findDependencia($id);
        $objeto = $this->findColaborador($id);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;

        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);

        return $this->render('index2', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }

    public function actionCambio($rutColaborador) {


        $model = $this->encuentraColaborador($rutColaborador);



        return $this->render('cambio', [
                    'model' => $model,
        ]);
    }

    public function actionPlanmenu($id) {

        $mandatorio = [];
        $model = $this->findDependencia2($id);
        $objeto = $this->findColaborador($model->Colaborador_rutColaborador1);
        // var_dump($model);die();
        if ($model->estado == 4 || $model->estado == 1) {
            
        } else {
            $model->estado = 3;
            $model->save();
        }


        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;


        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);
        //var_dump($secundarios);die();
        return $this->render('index2', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }
    
    
      public function actionPlanmenu2($id) {

        $mandatorio = [];
        $model = $this->findDependencia($id);
        $objeto = $this->findColaborador($id);
        // var_dump($model);die();
        


        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;


        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);
        //var_dump($secundarios);die();
        return $this->render('index2', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }
    public function actionDescarga($id) {



        $temporal = $this->findDependenciaUnica($id);
        if ($temporal->estado == 0) {
            throw new NotFoundHttpException('No es posible generar el documento ya que no se ha resuelto la evaluación.');
        }



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
        $plan = $this->findPlan($id);
        $comentario = $this->findDependenciaUnica($id);
        $objeto->comentario = $comentario->comentario;
        $objeto->plan = $plan->textoUno;
        $detalle = $this->findCalculador($id);
        $total = 0;
        $i = 0;

        foreach ($detalle as $det) {
            $total = $det["promedio"] + $total;
            $i++;
        }

        $objeto->total = $total / $i;


        $connection = Yii::$app->db;
        $sql = "SELECT 
                ei.idAutonumerico,
                ei.valor,
                c.nombreConductas,
                co.idCompetencias,
                co.nombreCompetencia,
                r.nombreRol,
                r.idRol
            FROM
                evaluacion_intermedia ei
                    INNER JOIN
                conductas c ON ei.idConductas = c.idConductas
                    INNER JOIN
                competencias co ON co.idCompetencias = ei.idCompetencias
                            INNER JOIN
                    rol r on r.idRol=co.idRol
            WHERE
                ei.idDependencias =" . $id . " and r.idRol=17";


        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model = $dataReader->readAll();




        $connection = Yii::$app->db;
        $sql1 = "SELECT 
                ei.idAutonumerico,
                ei.valor,
                c.nombreConductas,
                co.idCompetencias,
                co.nombreCompetencia,
                r.nombreRol,
                r.idRol
            FROM
                evaluacion_intermedia ei
                    INNER JOIN
                conductas c ON ei.idConductas = c.idConductas
                    INNER JOIN
                competencias co ON co.idCompetencias = ei.idCompetencias
                            INNER JOIN
                    rol r on r.idRol=co.idRol
            WHERE
                ei.idDependencias =" . $id . " and r.idRol=" . $objeto->idRol . "";


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
                    'colaborador1' => $this->findColaborador($temporal->Colaborador_rutColaborador),
        ]));
        $mpdf->Output('Acuerdo.pdf', 'D');
    }

    public function actionFin($id) {

        $mandatorio = [];
        $model = $this->findDependencia2($id);
        //var_dump();die();
        $objeto = $this->findColaborador($model->Colaborador_rutColaborador1);
        $model->estado = 4;
        $model->save(false);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;


        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);

        return $this->render('index4', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }

    public function actionFin2($id) {

        $mandatorio = [];
        $model = $this->findDependencia($id);
        $objeto = $this->findColaborador($id);


        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;


        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);

        return $this->render('index4', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }

    public function actionDescargau($id) {



        $temporal = $this->findDependenciaUnica($id);




        $model2 = $this->findColaborador($temporal->Colaborador_rutColaborador1);
        $objeto = new \yii\helpers\ArrayHelper();
        $objeto->rutColaborador = $model2->rutColaborador;
        $objeto->rutColaborador1 = $temporal->Colaborador_rutColaborador;
        $objeto->nombreColaborador = $model2->nombreColaborador;
        $objeto->apellidosColaborador = $model2->apellidosColaborador;
        //$objeto->area = $this->findArea($model2->idArea);
        //$objeto->cargo = $this->findCargo($model2->idCargo);
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


        $connection = Yii::$app->db;


        $jefe = "select * from rol where nombreRol like '%jefe%' and idRol=" . $objeto->idRol . "";
        $command = $connection->createCommand($jefe);
        $dataReader = $command->query();
        $model = $dataReader->readAll();
        if (empty($model)) {
            
        } else {
            $idNivel = 2;
        }



        $cnx = Yii::$app->db;
        $jefes = "select * from rol where nombreRol like '%Jefe Opera%' and idRol=" . $objeto->idRol . "";
        // var_dump($jefes);die();
        $command = $cnx->createCommand($jefes);
        $dataReader = $command->query();
        $modela = $dataReader->readAll();

        if (empty($modela)) {
            
        } else {
            $idNivel = 2;
        }

        $operarios = "select * from rol where nombreRol like '%opera%' and idRol=" . $objeto->idRol . "";
        $command = $connection->createCommand($operarios);
        $dataReader = $command->query();
        $model1 = $dataReader->readAll();

        if (empty($model1)) {
            
        } else {
            $idNivel = 4;
        }

        $profesional = "select * from rol where nombreRol like '%profe%' and idRol=" . $objeto->idRol . "";
        $command = $connection->createCommand($profesional);
        $dataReader = $command->query();
        $model2 = $dataReader->readAll();

        //var_dump($profesional);die();
        if (empty($model2)) {
            
        } else {
            $idNivel = 3;
        }


        $gerente = "select * from rol where nombreRol like '%gerente%' and idRol=" . $objeto->idRol . "";
        $command = $connection->createCommand($gerente);
        $dataReader = $command->query();
        $model3 = $dataReader->readAll();
        //var_dump($gerente);die();
        if (empty($model3)) {
            
        } else {
            $idNivel = 1;
        }

        $controller = "select * from rol where nombreRol like '%Controller%' and idRol=" . $objeto->idRol . "";
        $command = $connection->createCommand($controller);
        $dataReader = $command->query();
        $model5 = $dataReader->readAll();
        //var_dump($gerente);die();
        if (empty($model5)) {
            
        } else {
            $idNivel = 1;
        }


        $fiscal = "select * from rol where nombreRol like '%fiscal%' and idRol=" . $objeto->idRol . "";
        $command = $connection->createCommand($fiscal);
        $dataReader = $command->query();
        $model6 = $dataReader->readAll();
        //var_dump($gerente);die();
        if (empty($model6)) {
            
        } else {
            $idNivel = 1;
        }

        $jefe = "select * from rol where nombreRol like '%Jefe Operaciones y Adquisiciones%' and idRol=" . $id . "";
        $command = $connection->createCommand($jefe);
        $dataReader = $command->query();
        $model = $dataReader->readAll();

        if (empty($model)) {
            
        } else {
            $idNivel = 2;
        }

        $connection = Yii::$app->db;
        $sql = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol = 17 and cu.idNivel=" . $idNivel . "";



        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model = $dataReader->readAll();



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
        $mpdf->WriteHTML($this->renderPartial('finalu', [

                    'transversal' => $model,
                    'especifica' => $model1,
                    'objeto' => $objeto,
                    'colaborador0' => $this->findColaborador($model2->rutColaborador),
                    'colaborador1' => $this->findColaborador($objeto->rutColaborador1),
        ]));
        $mpdf->Output('Formulario Vacio.pdf', 'D');
    }

    public function actionSubir($id) {

        $mandatorio = [];
        $model = $this->findDependenciaUnica($id);
        $objeto = $this->findColaborador($model->Colaborador_rutColaborador);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;
        $mandatorio[7] = $objeto->cargoTexto;
        $mandatorio[8] = $objeto->gerenciaTexto;

        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);

        return $this->render('index3', [
                    'mandatorio' => $mandatorio,
                    'secundarios' => $secundarios,
        ]);
    }

    // FIN DE METODOS DE MENU
    //METODOS DE AVANCE

    public function actionAvanzapa($rutColaborador) {

        $model = $this->findColaborador($rutColaborador);
        $model->estado = 2;
        $model->save();

        Yii::$app->response->redirect(array('navegacion/plan', 'rutEvaluador' => $rutColaborador));
    }

    // FIN DE METODOS DE AVANCE
    // METODOS DE ACCIONES
    public function actionFinalizador() {

       
        $model = Yii::$app->request->post();
        $contador = count($model);
        $contador = $contador - 2;
        $comentario = Yii::$app->request->post()["comentario"];
       
        $id = Yii::$app->request->post()["id"];
        
        $i=0;
       
        foreach($model as $m){

            if($i==0){
                $i=1;
            }
            else{
                if($i<$contador){
                $i++;
                $returnValue = explode('-', $m, 3);
                $competencia = $returnValue[0];
                $conducta = $returnValue[1];
                $valor = $returnValue[2];
                
                 $connection = Yii::$app->db;
                $connection->createCommand()
                        ->insert('evaluacion_intermedia', [
                            'idCompetencias' => $competencia,
                            'idConductas' => $conducta,
                            'valor' => $valor,
                            'idDependencias' => $id,
                        ])
                        ->execute();



                }
            }

           
           

        }
        
        
        
     
       

        $modelo = $this->findDependenciaUnica($id);
        if($comentario==""){

        }else{
        $modelo->comentario =  $comentario;
        }
       
        $modelo->estado = 2;
        $modelo->save();

        $mandatorio = [];

        $model = $this->findDependencia($modelo->Colaborador_rutColaborador);

        $objeto = $this->findColaborador($modelo->Colaborador_rutColaborador);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;
        $mandatorio[5] = $model->idDependencias;
        $mandatorio[6] = $model->estado;

        $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);

        $connection = Yii::$app->db;
        $sql = "select * from dependencias where Colaborador_rutColaborador =" . $model->Colaborador_rutColaborador . "";
        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $result = $dataReader->readAll();

        $validador = 0;
        foreach ($result as $r) {
            if ($r["estado"] != 2) {
                $validador = 1;
            }
        }

        if ($validador == 0) {

            $guarda = $this->findColaborador($model->colaboradorRutColaborador->rutColaborador);

            $guarda->estado = 1;
            $guarda->save();
        }


        $i = 0;
        foreach ($secundarios as $s) {
            if ($s[3] != 2) {
                $i = 1;
            }
        }

        if ($i == 0) {
                    Yii::$app->response->redirect(array('navegacion/inicio', 'id' => $model->Colaborador_rutColaborador));

        } else {
            //var_dump($mandatorio);die();
                    Yii::$app->response->redirect(array('navegacion/inicio', 'id' => $model->Colaborador_rutColaborador));

        }
    }

    protected function encuentraColaborador($rutColaborador) {
        if (($model = Colaborador::findOne(['rutColaborador' => $rutColaborador])) !== null) {
            return $model;
        } else {
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionModal($id) {
        $model = new \app\models\Planes();


        if (Yii::$app->request->post()) {
            $model->textoUno = Yii::$app->request->post()["Planaccion"]["textoUno"];
            $model->idDependencia = Yii::$app->request->post()["idDependencia"];
            $model->save(false);
            $dependecia = $this->findDependenciaUnica($model->idDependencia);
            $dependecia->estado = 3;
            $dependecia->save();

            $id = $dependecia->Colaborador_rutColaborador;

            $mandatorio = [];
            $model = $this->findDependencia($id);
            $objeto = $this->findColaborador($id);

            $mandatorio[0] = $this->findArea($objeto->idArea);
            $mandatorio[1] = $this->findCargo($objeto->idCargo);
            $mandatorio[2] = $objeto->nombreColaborador;
            $mandatorio[3] = $objeto->apellidosColaborador;
            $mandatorio[4] = $objeto->rutColaborador;
            $mandatorio[5] = $model->idDependencias;
            $mandatorio[6] = $model->estado;

            $secundarios = $this->findColaboradores($model->Colaborador_rutColaborador);
        } else {
            return $this->renderAjax('_formp', [
                        'model' => $model,
                        'id' => $id,
            ]);
        }
    }

    public function actionPlan($id) {
        //var_dump(Yii::$app->request->post());die();

        $modeloUno = $this->findColaboradoresu($id);
        $busqueda = $this->findPlanExistente($id);
        //var_dump($busqueda);die();

        $listado = [];
        $i = 0;
        foreach ($modeloUno as $m) {
            // var_dump($m);die();
            $objeto = new \yii\helpers\ArrayHelper;
            // $objeto->Evaluador = $rutEvaluador;
            $objeto->Evaluado = $m[2];
            $objeto->nombreEvaluado = $m[0];
            $objeto->detalle = $this->findCalculador($m[3]);
            //var_dump($objeto->detalle);die();
            $objeto->estado = $m[4];
            $objeto->idRol = $m[5];

            $listado[$id] = $objeto;
            $i++;
        }

        $model = new \app\models\Planes();

        //var_dump($competencias);die();
        if (Yii::$app->request->post()) {

            $valid = $this->findPlanExistente($id);
            $busqueda = $this->findPlanExistente($id);
            //var_dump($valid);die();

            if ($valid != null) {

                $model->texto1 = Yii::$app->request->post()["Planes"]["texto1"];
                $model->texto3 = Yii::$app->request->post()["Planes"]["texto3"];
                $model->idCompetencias = Yii::$app->request->post()["Planes"]["idCompetencias"];
                $model->idPlanAccion = $valid->idPlanAccion;
                $model->save();
            } else {
                $modelo = new Planaccion();
                $modelo->idDependencia = Yii::$app->request->post()["idDependencia"];
                $modelo->save(false);
                $busqueda = $this->findPlanExistente($id);
                //var_dump($modelo);die();
                $dependecia = $this->findDependenciaUnica($modelo->idDependencia);
                $dependecia->estado = 3;
                $dependecia->save();
                $model->texto1 = Yii::$app->request->post()["Planes"]["texto1"];
                $model->texto3 = Yii::$app->request->post()["Planes"]["texto3"];
                $model->idPlanAccion = $modelo->idPlanAccion;
                $model->idCompetencias = Yii::$app->request->post()["Planes"]["idCompetencias"];
                $model->save();
            }

            $searchModel = new \app\models\PlanesSearch();
            $dataProvider = $searchModel->search2($model->idPlanAccion);
            $plan = new \app\models\Planes();
            return $this->render('plan', [
                        'model' => $model,
                        'id' => $id,
                        'resultados' => $listado,
                        'plan' => $plan,
                        'idRol' => $objeto->idRol,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'busqueda' => $busqueda,
            ]);
        } else {
            if ($busqueda == null) {
                $searchModel = new \app\models\PlanesSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            } else {
                $searchModel = new \app\models\PlanesSearch();
                $dataProvider = $searchModel->search2($busqueda->idPlanAccion);
            }

            $plan = new \app\models\Planes();
            return $this->render('plan', [
                        'model' => $model,
                        'id' => $id,
                        'resultados' => $listado,
                        'plan' => $plan,
                        'idRol' => $objeto->idRol,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'busqueda' => $busqueda,
            ]);
        }
    }

    public function findItems($idRol) {
        $connection = Yii::$app->db;
        $sql1 = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol =" . $idRol . "";


        $command1 = $connection->createCommand($sql1);
        $dataReader1 = $command1->query();
        $model1 = $dataReader1->readAll();

        return $model1;
    }

    protected function findEvaluado($id) {
        if (($model = \app\models\Dependencias::findOne($id)) !== null) {

            $resultado = Colaborador::findOne(['rutColaborador' => $model->Colaborador_rutColaborador1]);

            return $resultado;
        } else {
           
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEvaluacion($id, $rol) {

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



        $connection = Yii::$app->db;
        $sql = "SELECT 
                ei.idAutonumerico,
                ei.valor,
                c.nombreConductas,
                co.idCompetencias,
                co.nombreCompetencia,
                co.descripcionCompetencia,
                r.nombreRol,
                r.idRol
            FROM
                evaluacion_intermedia ei
                    INNER JOIN
                conductas c ON ei.idConductas = c.idConductas
                    INNER JOIN
                competencias co ON co.idCompetencias = ei.idCompetencias
                            INNER JOIN
                    rol r on r.idRol=co.idRol
            WHERE
                ei.idDependencias =" . $id . " and r.idRol=" . $rol . "";


        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model = $dataReader->readAll();

        //var_dump($sql);die();
        if (empty($model)) {

            $retorno = $this->actionFinalizador($id);
            echo $retorno;
        } else {


            return $this->render('evaluacion', [
                        'model' => $model,
                        'objeto' => $objeto,
            ]);
        }
    }

    public function actionAcuerdo($id) {
        $model = new Acuerdo();
        $objeto = $this->findDependenciaUnica($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->idDependencia = $id;

            $model->file = UploadedFile::getInstances($model, 'ruta');

            foreach ($model->file as $file) {
                $file->saveAs('uploads/' . $id . '.' . $file->extension);
                $model->ruta = 'uploads/' . $id . '.' . $file->extension;
                $model->save();
            }
            $objeto->estado = 4;
            $objeto->save();

            // var_dump($objeto);die();
            Yii::$app->response->redirect(array('navegacion/fin', 'id' => $objeto->Colaborador_rutColaborador));
        } else {
            return $this->render('subir', [
                        'model' => $model,
                        'id' => $id,
            ]);
        }
    }

    // FIN METODOS DE ACCIONES








    public function actionResultados($rutEvaluador) {

        $modeloUno = $this->findColaboradores($rutEvaluador);
        //var_dump($modeloUno);die();
        $objeto = $this->findColaborador($modeloUno[0][2]);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;


        $listado = [];
        $i = 0;

        foreach ($modeloUno as $m) {
            //var_dump($m);die();
            $objeto = new \yii\helpers\ArrayHelper;
            // $objeto->Evaluador = $rutEvaluador;
            $objeto->Evaluado = $m[2];
            $objeto->nombreEvaluado = $m[0];
            $objeto->detalle = $this->findCalculador($m[3]);
            //var_dump($objeto->detalle);die();
            arsort($objeto->detalle);
            $objeto->estado = $m[4];
            $objeto->idRol = $m[6];
            $objeto->dependencia = $m[3];
            $listado[$i] = $objeto;
            $i++;
        }
        //sort($listado);
        ?><pre><?php
       // var_dump($listado);die();
        ?></pre><?php
        return $this->render('nota', [
                    'resultados' => $listado,
                    'evaluador' => $rutEvaluador,
                    'mandatorio' => $mandatorio,
        ]);
    }

    public function actionResultadosu($id) {

        $modeloUno = $this->findColaboradoresu($id);
        $objeto = $this->findColaborador($modeloUno[0][2]);

        $mandatorio[0] = $this->findArea($objeto->idArea);
        $mandatorio[1] = $this->findCargo($objeto->idCargo);
        $mandatorio[2] = $objeto->nombreColaborador;
        $mandatorio[3] = $objeto->apellidosColaborador;
        $mandatorio[4] = $objeto->rutColaborador;


        $listado = [];
        $i = 0;
        foreach ($modeloUno as $m) {
            //var_dump($m);die();
            $objeto = new \yii\helpers\ArrayHelper;
            // $objeto->Evaluador = $rutEvaluador;
            $objeto->Evaluado = $m[2];
            $objeto->nombreEvaluado = $m[0];
            $objeto->detalle = $this->findCalculador($m[3]);
            //var_dump($objeto->detalle);die();
            $objeto->estado = $m[4];

            $listado[$id] = $objeto;
            $i++;
        }
        return $this->render('nota1', [
                    'resultados' => $listado,
                    'dependencia' => $id,
                    'mandatorio' => $mandatorio,
        ]);
    }

    protected function findCalculador($idDependencia) {

        $query = new \yii\db\Query;
        $query->select([
                    'competencias.nombreCompetencia',
                    'SUM(evaluacion_intermedia.valor) / COUNT(evaluacion_intermedia.idCompetencias) as promedio',
                    'competencias.idCompetencias',
                    'evaluacion_intermedia.idConductas',
                    'evaluacion_intermedia.idDependencias']
                )
                ->from('evaluacion_intermedia')
                ->join('INNER JOIN', 'competencias', 'competencias.idCompetencias =evaluacion_intermedia.idCompetencias')
                ->join('INNER JOIN', 'conductas', 'conductas.idCompetencia =competencias.idCompetencias')
                ->where("evaluacion_intermedia.idDependencias={$idDependencia}")
                ->groupBy('evaluacion_intermedia.idCompetencias')
                ->orderBy(['promedio' => SORT_ASC])
                ->all();

        $command = $query->createCommand();
        $data = $command->queryAll();
        //var_dump($idDependencia);die();
        return $data;
    }

    public function actionActualiza($id, $idV) {


        $connection = Yii::$app->db;
        $sql = "UPDATE evaluacion_intermedia SET valor = " . $idV . " WHERE evaluacion_intermedia.idAutoNumerico = " . $id . "";
        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        return "Si llego el dato";
    }

    public function actionActualizar($idA, $idB, $valor, $dependencia) {

        $validador = $this->findEvaluacion($idA, $idB, $dependencia);

        if ($validador) {
            if ($validador->valor == $valor && $validador->idCompetencias === $idA && $validador->idConductas == $idB) {
                
            } else {
                $validador->valor = $valor;
                $validador->save(false);
            }
        } else {
            $model = new \app\models\EvaluacionIntermedia();

            $model->idCompetencias = $idA;
            $model->idConductas = $idB;
            $model->valor = $valor;
            $model->idDependencias = $dependencia;
            $model->save(false);
        }
    }

    protected function findEvaluacion($idCompetencias, $idConductas, $idDependencias) {
        if (($model = \app\models\EvaluacionIntermedia::findOne(['idCompetencias' => $idCompetencias, 'idConductas' => $idConductas, 'idDependencias' => $idDependencias])) !== null) {



            return $model;
        } else {
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // METODOS DE BUSQUEDA 



    protected function findColaborador($id) {

        if (($model = Colaborador::findOne(['rutColaborador' => $id])) !== null) {


            return $model;
        } else {
            
        }
    }

    protected function findColaboradoresu($id) {



        $connection = Yii::$app->db;
        $sql = "select d.Colaborador_rutColaborador1, d.idDependencias, d.estado from colaborador c inner join dependencias d on c.rutColaborador=d.Colaborador_rutColaborador where d.idDependencias=" . $id . "";
        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model1 = $dataReader->readAll();


        foreach ($model1 as $d) {

            $sql1 = "select * from colaborador  where rutColaborador=" . $d["Colaborador_rutColaborador1"] . "";
            $command = $connection->createCommand($sql1);
            $dataReader = $command->query();
            $model = $dataReader->readAll();
            //var_dump($sql1);die;


            foreach ($model as $m) {


                $out[] = Array($m['nombreColaborador'], $m['apellidosColaborador'], $m['rutColaborador'], $d['idDependencias'], $d['estado'], $m['idRol']);
            }
        }


        return $out;
    }

    protected function findColaboradores($id) {



        $connection = Yii::$app->db;
        $sql = "select d.Colaborador_rutColaborador1, d.idDependencias, d.estado from colaborador c inner join dependencias d on c.rutColaborador=d.Colaborador_rutColaborador where d.Colaborador_rutColaborador=" . $id . "";
        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model1 = $dataReader->readAll();



        foreach ($model1 as $d) {

            $sql1 = "select * from colaborador inner join cargos on colaborador.idCargo=cargos.idCargo  where colaborador.rutColaborador=" . $d["Colaborador_rutColaborador1"] . "";
            $command = $connection->createCommand($sql1);
            $dataReader = $command->query();
            $model = $dataReader->readAll();
            //var_dump($sql1);die();

            foreach ($model as $m) {


                $out[] = Array($m['nombreColaborador'], $m['apellidosColaborador'], $m['rutColaborador'], $d['idDependencias'], $d['estado'], $m['rutColaborador'], $m['idRol'], $m['nombreCargo']);
            }
        }


        return $out;
    }

    protected function findDependencia($id) {


        if (($model = Dependencias::findOne(['Colaborador_rutColaborador' => $id])) !== null) {


            return $model;
        } else {
            // throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findDependencia2($id) {


        if (($model = Dependencias::findOne(['idDependencias' => $id])) !== null) {


            return $model;
        } else {
            // throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findDependenciaUnica($id) {
        if (($model = Dependencias::findOne(['idDependencias' => $id])) !== null) {
            return $model;
        } else {
            $resultado = Dependencias::findOne(['Colaborador_rutColaborador' => $id]);
            return $resultado;
        }
    }

    protected function findCargo($id) {
        if (($model = \app\models\Cargos::findOne($id)) !== null) {
            return $model->nombreCargo;
        } else {
            //  throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRutendependencia($id) {
        if (($model = \app\models\Dependencias::findOne($id)) !== null) {

            $resultado = Colaborador::findOne(['rutColaborador' => $model->Colaborador_rutColaborador]);

            return $resultado;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findArea($id) {
        if (($model = \app\models\Area::findOne($id)) !== null) {
            return $model->nombreArea;
        } else {
            return 0;
        }
    }

    protected function findPlan($id) {
        if (($model = Planaccion::findOne(['idDependencia' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPlanExistente($id) {
        if (($model = Planaccion::findOne(['idDependencia' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    protected function findPlan2($id) {
        if (($model = Planaccion::findOne(['idPlanAccion' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAcuerdo($id) {
        if (($model = Acuerdo::findOne(['idDependencia' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCompetencias($idRol) {
        if (($model = \app\models\Competencias::findAll(['idRol' => $idRol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCompetenciast() {
        if (($model = \app\models\Competencias::findAll(['idRol' => 17])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelete($id) {

        $model = $this->findPlanes($id);
        $model2 = $this->findPlan2($model->idPlanAccion);
        $this->findPlanes($id)->delete();


        Yii::$app->response->redirect(array('navegacion/plan', 'id' => $model2->idDependencia));
    }

    protected function findPlanes($id) {
        if (($model = \app\models\Planes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    function actionQuery($fileName = 'Consolidado.xlsx') {
        // initialise excel column name
        // currently limited to queries with less than 27 columns
        // Execute the database query

        $connection = Yii::$app->db;
        $sql = "select * from rol";


        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $roles = $dataReader->readAll();


        // Instantiate a new PHPExcel object
        $objPHPExcel = new \PHPExcel();

        //First sheet
        $sheet = $objPHPExcel->getActiveSheet();

        //Start adding next sheets
        $i = 0;
        foreach ($roles as $rol) {

            $connection = Yii::$app->db;
            $sql = "SELECT 
                            d.idDependencias as 'dependencia',
                            d.comentario as 'comentario',
                            c.rutColaborador as 'rutEvaluador',
                            c.nombreColaborador as 'colaborador 1',
                            c.apellidosColaborador as 'apellido1',
                            co.rutColaborador as 'rutEvaluado',
                            co.nombreColaborador as 'colaborador 2',
                            co.apellidosColaborador as 'apellido2',
                            co.idRol as 'instrumento',
                            r.nombreRol as 'nombreInstrumento'
                        FROM
                            colaborador c
                                INNER JOIN
                            dependencias d ON d.Colaborador_rutColaborador = c.rutColaborador
                                        INNER JOIN
                                colaborador co ON d.Colaborador_rutColaborador1 = co.rutColaborador
                                INNER JOIN
                            rol r on r.idRol=co.idRol
                            where co.idRol={$rol["idRol"]}";

            $command = $connection->createCommand($sql);
            $dataReader = $command->query();
            $relaciones = $dataReader->readAll();





            // Add new sheet
            $objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating
            //Write cells
            $highestRowA = $objWorkSheet->getHighestRow() + 1;
            $highestRowB = $objWorkSheet->getHighestRow();
            $highestRow = $objWorkSheet->getHighestRow();


            $objWorkSheet->setCellValueExplicitByColumnAndRow(1, 1, 'Rut Evaluador');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(2, 1, 'Evaluador');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(3, 1, 'Direccion');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(4, 1, 'Rut Evaluado');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(5, 1, 'Evaluado');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(6, 1, 'Instrumento');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(7, 1, 'Promedio');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(8, 1, 'Comentario');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(9, 1, 'plan de accion');


            if ($rol["idRol"] == 17) {
                
            } else {


                $competencias = $this->findCompetenciasbarra($rol["idRol"]);
                $conductas = $this->findTransversales($rol["idRol"] );
                $contador = 10;
                foreach ($competencias as $delta) {



                    $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, 1, $delta["nombreCompetencia"]);
                    $celda = $objWorkSheet->getColumnDimensionByColumn($contador);
                    $renglon = $celda->getColumnIndex() . '1';
                    $objWorkSheet->getStyle($renglon)->getFill()->applyFromArray(array(
                        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                        'startcolor' => array(
                            'rgb' => 'F28A8C'
                        )
                    ));
                    $contador++;
                }



                foreach ($conductas as $t) {

                    $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, 1, $t["nombreConductas"]);
                    //  $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, $alto, $t["valor"]);
                    $contador++;
                }



               
            }


            $banderaSuprema = $contador;


            foreach ($relaciones as $r) {

                $highestRowA = $objWorkSheet->getHighestRow() + 1;
                $highestRowB = $objWorkSheet->getHighestRow();
                $highestRow = $objWorkSheet->getHighestRow();
                $detalle = $this->findCalculador($r['dependencia']);
                $detallea = $this->findCalculadora($r['dependencia']);


                $total = 0;
                $j = 0;
                foreach ($detalle as $det) {

                
                    if ($det["promedio"] == 0) {
//                        var_dump($det);
//                        die();
                    } else {
                        $total = $det["promedio"] + $total;
                        $j++;
                    }
                }
                $detalle = 0;
                //$nivel = $this->findNivel($rol["idRol"]);


                $connection = Yii::$app->db;
                $sql1 = "SELECT 
                ei.idAutonumerico,
                ei.valor,
                ei.idConductas,
                ei.idDependencias,
                c.nombreConductas as 'laconducta',
                co.idCompetencias,
                co.nombreCompetencia,
                r.nombreRol,
                r.idRol
            FROM
                evaluacion_intermedia ei
                    INNER JOIN
                conductas c ON ei.idConductas = c.idConductas
                    INNER JOIN
                competencias co ON co.idCompetencias = ei.idCompetencias
                            INNER JOIN
                    rol r on r.idRol=co.idRol
            WHERE
                ei.idDependencias =" . $r["dependencia"] . " and r.idRol in ({$r["instrumento"]},17) order by ei.idConductas";









                $command1 = $connection->createCommand($sql1);
                $dataReader1 = $command1->query();
                $conductas = $dataReader1->readAll();


         
                if ($j == 0) {
                    
                } else {
                    $promedio = $total / $j;
                    $promedio = round($promedio, 1, PHP_ROUND_HALF_DOWN);
                }


                $alto = $highestRowA;
                $objWorkSheet->setCellValue('A' . $alto, $r["dependencia"])
                        ->setCellValue('B' . $alto, $r["rutEvaluador"])
                        ->setCellValue('C' . $alto, $r["colaborador 1"] . " " . $r["apellido1"])
                        ->setCellValue('D' . $alto, '-------->')
                        ->setCellValue('E' . $alto, $r["rutEvaluado"])
                        ->setCellValue('F' . $alto, $r["colaborador 2"] . " " . $r["apellido2"])
                        ->setCellValue('G' . $alto, $r["nombreInstrumento"])
                        ->setCellValue('H' . $alto, $promedio)
                        ->setCellValue('I' . $alto, $r["comentario"]);
                $contador = 10;


                $bandera = 1;





                $contador = 10;
                $bandera = 1;
                foreach ($detallea as $d) {



                    $columna = $objWorkSheet->getCellByColumnAndRow($contador, 1)->getValue();
                    $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, $alto, round($d["promedio"], 1, PHP_ROUND_HALF_DOWN));
                    $contador++;

                    if ($bandera == 1) {
                        $aux = $bandera = 2;
                    } else {
                        
                    }
                }


            






                $promedio = 0;
                $highestRowA++;
                $planfinal = 0;
                $contador = 0;
            }






            // Rename sheet
            $nombre = substr($rol["nombreRol"], 0, 31);
            $nombreFinal = $this->normaliza($nombre);
            $objWorkSheet->setTitle($nombreFinal);

            $i++;
        }





        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
    }
    
    
    function actionQuerydatos($fileName = 'Consolidado.xlsx') {
        // initialise excel column name
        // currently limited to queries with less than 27 columns
        // Execute the database query

        $connection = Yii::$app->db;
        $sql = "select * from rol";


        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $roles = $dataReader->readAll();


        // Instantiate a new PHPExcel object
        $objPHPExcel = new \PHPExcel();

        //First sheet
        $sheet = $objPHPExcel->getActiveSheet();

        //Start adding next sheets
        $i = 0;
        foreach ($roles as $rol) {

            $connection = Yii::$app->db;
            $sql = "SELECT 
                            d.idDependencias as 'dependencia',
                            d.comentario as 'comentario',
                            c.rutColaborador as 'rutEvaluador',
                            c.nombreColaborador as 'colaborador 1',
                            c.apellidosColaborador as 'apellido1',
                            co.rutColaborador as 'rutEvaluado',
                            co.nombreColaborador as 'colaborador 2',
                            co.apellidosColaborador as 'apellido2',
                            co.idRol as 'instrumento',
                            r.nombreRol as 'nombreInstrumento'
                        FROM
                            colaborador c
                                INNER JOIN
                            dependencias d ON d.Colaborador_rutColaborador = c.rutColaborador
                                        INNER JOIN
                                colaborador co ON d.Colaborador_rutColaborador1 = co.rutColaborador
                                INNER JOIN
                            rol r on r.idRol=co.idRol
                            where co.idRol={$rol["idRol"]}";

            $command = $connection->createCommand($sql);
            $dataReader = $command->query();
            $relaciones = $dataReader->readAll();





            // Add new sheet
            $objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating
            //Write cells
            $highestRowA = $objWorkSheet->getHighestRow() + 1;
            $highestRowB = $objWorkSheet->getHighestRow();
            $highestRow = $objWorkSheet->getHighestRow();


            $objWorkSheet->setCellValueExplicitByColumnAndRow(1, 1, 'Rut Evaluador');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(2, 1, 'Evaluador');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(3, 1, 'Direccion');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(4, 1, 'Rut Evaluado');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(5, 1, 'Evaluado');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(6, 1, 'Instrumento');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(7, 1, 'Promedio');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(8, 1, 'Comentario');
            $objWorkSheet->setCellValueExplicitByColumnAndRow(9, 1, 'plan de accion');


            if ($rol["idRol"] == 17) {
                
            } else {


                $nivel = $this->findNivel($rol["idRol"]);
                $competencias = $this->findCompetenciasbarra($rol["idRol"]);
                $conductas = $this->findTransversales($nivel,$rol["idRol"] );
                
                if($rol["idRol"]==37){
                    //var_dump($conductas);die();
                }
                $contador = 10;
                foreach ($competencias as $delta) {



                    $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, 1, $delta["nombreCompetencia"]);
                    $celda = $objWorkSheet->getColumnDimensionByColumn($contador);
                    $renglon = $celda->getColumnIndex() . '1';
                    $objWorkSheet->getStyle($renglon)->getFill()->applyFromArray(array(
                        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                        'startcolor' => array(
                            'rgb' => 'F28A8C'
                        )
                    ));
                    $contador++;
                }



                foreach ($conductas as $t) {

                    $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, 1, $t["idConductas"]);
                    //  $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, $alto, $t["valor"]);
                    $contador++;
                }



               
            }


            $banderaSuprema = $contador;


            foreach ($relaciones as $r) {

                $highestRowA = $objWorkSheet->getHighestRow() + 1;
                $highestRowB = $objWorkSheet->getHighestRow();
                $highestRow = $objWorkSheet->getHighestRow();
                $detalle = $this->findCalculador($r['dependencia']);
                $detallea = $this->findCalculadora($r['dependencia']);


                $total = 0;
                $j = 0;
                foreach ($detallea as $det) {


                    if ($det["promedio"] == 0) {
//                        var_dump($det);
//                        die();
                    } else {
                        $total = $det["promedio"] + $total;
                        $j++;
                    }
                }
                $detalle = 0;
                //$nivel = $this->findNivel($rol["idRol"]);


                $connection = Yii::$app->db;
                $sql1 = "SELECT 
                ei.idAutonumerico,
                ei.valor,
                ei.idConductas,
                ei.idDependencias,
                c.nombreConductas as 'laconducta',
                co.idCompetencias,
                co.nombreCompetencia,
                r.nombreRol,
                r.idRol
            FROM
                evaluacion_intermedia ei
                    INNER JOIN
                conductas c ON ei.idConductas = c.idConductas
                    INNER JOIN
                competencias co ON co.idCompetencias = ei.idCompetencias
                            INNER JOIN
                    rol r on r.idRol=co.idRol
            WHERE
                ei.idDependencias =" . $r["dependencia"] . " and r.idRol in ({$r["instrumento"]},17) order by ei.idConductas";









                $command1 = $connection->createCommand($sql1);
                $dataReader1 = $command1->query();
                $conductas = $dataReader1->readAll();


                $connection = Yii::$app->db;
                $sql3 = "SELECT 
                    
                           
                           textoUno as 'plan'
                        FROM
                          		planaccion
                            where idDependencia={$r["dependencia"]}";

                $command3 = $connection->createCommand($sql3);
                $dataReader3 = $command3->query();
                $plan = $dataReader3->readAll();
                $planfinal = 0;
                foreach ($plan as $p) {
                    $planfinal = $p["plan"];
                }


                if ($j == 0) {
                    
                } else {
                    $promedio = $total / $j;
                    $promedio = round($promedio, 1, PHP_ROUND_HALF_DOWN);
                }


                $alto = $highestRowA;
                $objWorkSheet->setCellValue('A' . $alto, $r["dependencia"])
                        ->setCellValue('B' . $alto, $r["rutEvaluador"])
                        ->setCellValue('C' . $alto, $r["colaborador 1"] . " " . $r["apellido1"])
                        ->setCellValue('D' . $alto, '-------->')
                        ->setCellValue('E' . $alto, $r["rutEvaluado"])
                        ->setCellValue('F' . $alto, $r["colaborador 2"] . " " . $r["apellido2"])
                        ->setCellValue('G' . $alto, $r["nombreInstrumento"])
                        ->setCellValue('H' . $alto, $promedio)
                        ->setCellValue('I' . $alto, $r["comentario"])
                        ->setCellValue('J' . $alto, $planfinal);
                $contador = 10;


                $bandera = 1;





                $contador = 10;
                $bandera = 1;
                foreach ($detallea as $d) {



                    $columna = $objWorkSheet->getCellByColumnAndRow($contador, 1)->getValue();
                    $objWorkSheet->setCellValueExplicitByColumnAndRow($contador, $alto, round($d["promedio"], 1, PHP_ROUND_HALF_DOWN));
                    $contador++;

                    if ($bandera == 1) {
                        $aux = $bandera = 2;
                    } else {
                        
                    }
                }


                foreach ($conductas as $e) {

                    $row = 1;
                    $lastColumn = $objWorkSheet->getHighestColumn();
                    $lastColumn++;
                    for ($column = 'A'; $column != $lastColumn; $column++) {



                        $cell = $objWorkSheet->getCell($column . $row);
                        $celda = $cell->getValue();
                        $pocision = $cell->getColumn();
                        if ($celda == $e["idConductas"]) {

                            $objWorkSheet->setCellValue($column.$alto, $e["valor"]);
                        }
                    }
                }






                $promedio = 0;
                $highestRowA++;
                $planfinal = 0;
                $contador = 0;
            }






            // Rename sheet
            $nombre = substr($rol["nombreRol"], 0, 31);
            $nombreFinal = $this->normaliza($nombre);
            $objWorkSheet->setTitle($nombreFinal);

            $i++;
        }





        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
    }

    function normaliza($cadena) {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }

    public function findTransversales($id) {
        $connection = Yii::$app->db;
        $sql = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol in(17, {$id} ) order by cu.idConductas";

           
       
        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model = $dataReader->readAll();

        return $model;
    }

    public function findEspecificas($id) {
        $connection = Yii::$app->db;
        $sql1 = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol =" . $id . " order by cu.idConductas";


        $command1 = $connection->createCommand($sql1);
        $dataReader1 = $command1->query();
        $model1 = $dataReader1->readAll();
        return $model1;
    }


        protected function findCompetenciasbarra($idRol) {

        $query = new \yii\db\Query;
        $query->select([
                    'competencias.nombreCompetencia',
                        ]
                )
                ->from('competencias')
                ->where("competencias.idRol in ({$idRol})")
                ->groupBy('competencias.idCompetencias')
                ->all();

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }

       protected function findCalculadora($idDependencia) {

        $connection = Yii::$app->db;
        $sql = "SELECT
                        avg(ei.valor) as promedio, co.nombreCompetencia

                FROM
                    evaluacion_intermedia ei
                        INNER JOIN
                    competencias co ON co.idCompetencias = ei.idCompetencias
                        	
                WHERE
                    ei.idDependencias = {$idDependencia}   group by co.nombreCompetencia order by ei.idConductas";

        $command = $connection->createCommand($sql);
        $dataReader = $command->query();
        $model1 = $dataReader->readAll();

        return $model1;
    }


}
