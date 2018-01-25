<?php

namespace backend\controllers;

use Yii;
use app\models\Dependencias;
use app\models\DependenciasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DependenciasController implements the CRUD actions for Dependencias model.
 */
class DependenciasController extends Controller
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
     * Lists all Dependencias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DependenciasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dependencias model.
     * @param integer $idDependencias
     * @param integer $Colaborador_rutColaborador
     * @param integer $Colaborador_rutColaborador1
     * @return mixed
     */
    public function actionView($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1)
    {
        return $this->render('view', [
            'model' => $this->findModel($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1),
        ]);
    }

    /**
     * Creates a new Dependencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dependencias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDependencias' => $model->idDependencias, 'Colaborador_rutColaborador' => $model->Colaborador_rutColaborador, 'Colaborador_rutColaborador1' => $model->Colaborador_rutColaborador1]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dependencias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idDependencias
     * @param integer $Colaborador_rutColaborador
     * @param integer $Colaborador_rutColaborador1
     * @return mixed
     */
    public function actionUpdate($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1)
    {
        $model = $this->findModel($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDependencias' => $model->idDependencias, 'Colaborador_rutColaborador' => $model->Colaborador_rutColaborador, 'Colaborador_rutColaborador1' => $model->Colaborador_rutColaborador1]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dependencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idDependencias
     * @param integer $Colaborador_rutColaborador
     * @param integer $Colaborador_rutColaborador1
     * @return mixed
     */
    public function actionDelete($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1)
    {
        $this->findModel($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dependencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idDependencias
     * @param integer $Colaborador_rutColaborador
     * @param integer $Colaborador_rutColaborador1
     * @return Dependencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idDependencias, $Colaborador_rutColaborador, $Colaborador_rutColaborador1)
    {
        if (($model = Dependencias::findOne(['idDependencias' => $idDependencias, 'Colaborador_rutColaborador' => $Colaborador_rutColaborador, 'Colaborador_rutColaborador1' => $Colaborador_rutColaborador1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
