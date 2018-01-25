<?php

namespace app\controllers;

use Yii;
use app\models\CompCond;
use app\models\CompCondSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompCondController implements the CRUD actions for CompCond model.
 */
class CompCondController extends Controller
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
     * Lists all CompCond models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompCondSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompCond model.
     * @param integer $idComp_Cond
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @return mixed
     */
    public function actionView($idComp_Cond, $idCompetencias, $idConductas)
    {
        return $this->render('view', [
            'model' => $this->findModel($idComp_Cond, $idCompetencias, $idConductas),
        ]);
    }

    /**
     * Creates a new CompCond model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompCond();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idComp_Cond' => $model->idComp_Cond, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompCond model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idComp_Cond
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @return mixed
     */
    public function actionUpdate($idComp_Cond, $idCompetencias, $idConductas)
    {
        $model = $this->findModel($idComp_Cond, $idCompetencias, $idConductas);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idComp_Cond' => $model->idComp_Cond, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompCond model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idComp_Cond
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @return mixed
     */
    public function actionDelete($idComp_Cond, $idCompetencias, $idConductas)
    {
        $this->findModel($idComp_Cond, $idCompetencias, $idConductas)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompCond model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idComp_Cond
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @return CompCond the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idComp_Cond, $idCompetencias, $idConductas)
    {
        if (($model = CompCond::findOne(['idComp_Cond' => $idComp_Cond, 'idCompetencias' => $idCompetencias, 'idConductas' => $idConductas])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
