<?php

namespace backend\controllers;

use Yii;
use app\models\Rol;
use app\models\RolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;

/**
 * RolController implements the CRUD actions for Rol model.
 */
class RolController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Rol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rol model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rol();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRol]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }



     public function actionDescargau($id) {
               





        $connection = Yii::$app->db;


          $jefe = "select * from rol where nombreRol like '%jefe%' and idRol=" . $id . "";
        $command = $connection->createCommand($jefe);
        $dataReader = $command->query();
        $model = $dataReader->readAll();

       if (empty($model)) {
            
           }else{
               $idNivel =2;
           }

           

     

        $operarios = "select * from rol where nombreRol like '%Operario%' and idRol=" . $id . "";
        $command = $connection->createCommand($operarios);
        $dataReader = $command->query();
        $model1 = $dataReader->readAll();

        if (empty($model1)) {
            
           }else{
               $idNivel =4;
           }

           //var_dump($colaborador->idNivel);die();
        $profesional = "select * from rol where nombreRol like '%profe%' and idRol=" . $id . "";
        $command = $connection->createCommand($profesional);
        $dataReader = $command->query();
        $model2 = $dataReader->readAll();

        if (empty($model2)) {
            
           }else{
               $idNivel =3;
           }


        $gerente = "select * from rol where nombreRol like '%gerente%' and idRol=" . $id . "";
        $command = $connection->createCommand($gerente);
        $dataReader = $command->query();
        $model3 = $dataReader->readAll();
        //var_dump($gerente);die();
        if (empty($model3)) {
            
           }else{
               $idNivel =1;
           }

        $controller = "select * from rol where nombreRol like '%Controller%' and idRol=" . $id . "";
        $command = $connection->createCommand($controller);
        $dataReader = $command->query();
        $model5 = $dataReader->readAll();
        //var_dump($gerente);die();
        if (empty($model5)) {
            
           }else{
               $idNivel =1;
           }


        $fiscal = "select * from rol where nombreRol like '%fiscal%' and idRol=" . $id . "";
        $command = $connection->createCommand($fiscal);
        $dataReader = $command->query();
        $model6 = $dataReader->readAll();
        //var_dump($gerente);die();
        if (empty($model6)) {
            
           }else{
               $idNivel =1;
           }


  $jefe = "select * from rol where nombreRol like '%Jefe Operaciones y Adquisiciones%' and idRol=" . $id . "";
        $command = $connection->createCommand($jefe);
        $dataReader = $command->query();
        $model = $dataReader->readAll();

       if (empty($model)) {
            
           }else{
               $idNivel =2;
           }















        $connection = Yii::$app->db;
        $sql = "SELECT 
            *
        FROM
            competencias c
                INNER JOIN
            conductas cu ON c.idCompetencias = cu.idCompetencia
        WHERE
            c.idRol = 17 and cu.idNivel=".$idNivel."";

        

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
        $mpdf->WriteHTML($this->renderPartial('finalu', [

                    'transversal' => $model,
                    'especifica' => $model1,
                    
                   
        ]));
        $mpdf->Output('Acuerdo.pdf', 'D');
    }


    /**
     * Updates an existing Rol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRol]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rol::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
