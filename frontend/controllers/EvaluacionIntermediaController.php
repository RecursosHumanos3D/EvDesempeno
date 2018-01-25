<?php

namespace app\controllers;

use Yii;
use app\models\EvaluacionIntermedia;
use app\models\EvaluacionIntermediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EvaluacionIntermediaController implements the CRUD actions for EvaluacionIntermedia model.
 */
class EvaluacionIntermediaController extends Controller
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
     * Lists all EvaluacionIntermedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvaluacionIntermediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EvaluacionIntermedia model.
     * @param integer $idAutoNumerico
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @param integer $idEvalVal
     * @param integer $idEtapas
     * @param integer $idDependencias
     * @return mixed
     */
    public function actionView($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias)
    {
        return $this->render('view', [
            'model' => $this->findModel($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias),
        ]);
    }

    /**
     * Creates a new EvaluacionIntermedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EvaluacionIntermedia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idAutoNumerico' => $model->idAutoNumerico, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas, 'idEvalVal' => $model->idEvalVal, 'idEtapas' => $model->idEtapas, 'idDependencias' => $model->idDependencias]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EvaluacionIntermedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idAutoNumerico
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @param integer $idEvalVal
     * @param integer $idEtapas
     * @param integer $idDependencias
     * @return mixed
     */
    public function actionUpdate($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias)
    {
        $model = $this->findModel($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idAutoNumerico' => $model->idAutoNumerico, 'idCompetencias' => $model->idCompetencias, 'idConductas' => $model->idConductas, 'idEvalVal' => $model->idEvalVal, 'idEtapas' => $model->idEtapas, 'idDependencias' => $model->idDependencias]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EvaluacionIntermedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idAutoNumerico
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @param integer $idEvalVal
     * @param integer $idEtapas
     * @param integer $idDependencias
     * @return mixed
     */
    public function actionDelete($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias)
    {
        $this->findModel($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EvaluacionIntermedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idAutoNumerico
     * @param integer $idCompetencias
     * @param integer $idConductas
     * @param integer $idEvalVal
     * @param integer $idEtapas
     * @param integer $idDependencias
     * @return EvaluacionIntermedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idAutoNumerico, $idCompetencias, $idConductas, $idEvalVal, $idEtapas, $idDependencias)
    {
        if (($model = EvaluacionIntermedia::findOne(['idAutoNumerico' => $idAutoNumerico, 'idCompetencias' => $idCompetencias, 'idConductas' => $idConductas, 'idEvalVal' => $idEvalVal, 'idEtapas' => $idEtapas, 'idDependencias' => $idDependencias])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
