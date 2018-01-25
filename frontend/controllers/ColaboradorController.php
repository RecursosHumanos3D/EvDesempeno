<?php

namespace frontend\controllers;

use Yii;
use app\models\Colaborador;
use app\models\ColaboradorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ColaboradorController implements the CRUD actions for Colaborador model.
 */
class ColaboradorController extends Controller
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
     * Lists all Colaborador models.
     * @return mixed
     */
    public function actionIndex()
    {
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
    public function actionView($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea)
    {
        return $this->render('view', [
            'model' => $this->findModel($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea),
        ]);
    }

    /**
     * Creates a new Colaborador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Colaborador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rutColaborador' => $model->rutColaborador, 'rutEmpresa' => $model->rutEmpresa, 'idCargo' => $model->idCargo, 'idRol' => $model->idRol, 'idArea' => $model->idArea]);
        } else {
            return $this->render('create', [
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
    public function actionUpdate($rutColaborador)
    {
        $model = $this->findModel($rutColaborador);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['navegacion/inicio', 'id' => $model->rutColaborador]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
    public function actionDelete($rutColaborador, $rutEmpresa, $idCargo, $idRol, $idArea)
    {
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
    protected function findModel($rutColaborador)
    {
        if (($model = Colaborador::findOne(['rutColaborador' => $rutColaborador])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
