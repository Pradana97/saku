<?php

namespace app\controllers;

use app\models\Detailkelompokkelas;
use app\models\Kelompokkelas;
use app\models\Matapelajaran;
use Yii;
use yii\web\UploadedFile;
use app\models\Materi;
use app\models\MateriSearch;
use app\models\Murid;
use yii\web\{Controller, Response, NotFoundHttpException};
use yii\filters\VerbFilter;
use yii\helpers\{Html, Url, ArrayHelper};

class MateriController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new MateriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Materi #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Materi();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Materi",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {

                $pdf = UploadedFile::getInstance($model, 'dokumen');
                if (!empty($pdf)) {
                    $model->dokumen = $pdf;
                    $model->created_date = date('Y-m-d');
                    $model->save(false);
                    $pdf->saveAs(Yii::$app->basePath . '/web/uploads/materi/' . $model->id_materi . $pdf->name);
                } else {
                    // Yii::$app->session->setFlash('warning', "file belum di lengkapi, mohon untuk melengkapinya");
                    $model->save(false);
                }
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Create new Materi",
                    'content' => '<span class="text-success">Create Materi success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])

                ];
            } else {
                return [
                    'title' => "Create new Materi",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_materi]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldfile = $model->dokumen ?? '';
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Materi #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $pdf = UploadedFile::getInstance($model, 'dokumen');
                if (!empty($pdf)) {
                    unlink(Yii::$app->basePath . '/web/uploads/materi/' . $model->id_materi . $oldfile);
                    $model->dokumen = $pdf;
                    $model->save(false);
                    $pdf->saveAs(Yii::$app->basePath . '/web/uploads/materi/' . $model->id_materi . $pdf->name);
                } else {
                    $model->dokumen = $oldfile;
                    $model->save(false);
                }
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Materi #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])
                ];
            } else {
                return [
                    'title' => "Update Materi #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_materi]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldfile = $model->dokumen;
        unlink(Yii::$app->basePath . '/web/uploads/materi/' . $model->id_materi . $oldfile);
        $model->delete();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . $model->hash . '-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . $model->hash . '-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }
    protected function findModel($id)
    {
        if (($model = Materi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMateriuser()
    {
        $userid = Yii::$app->user->identity->id ?? '';
        $role = \Yii::$app->tools->getcurrentroleuser();
        $roleValue = reset($role);

        if ($roleValue == 'murid') {
            $datamurid = Murid::find()->where(['user_id' => $userid])->one()->id_murid;
            $datadetailkelompokkelas = Detailkelompokkelas::find()->where(['id_murid' => $datamurid])->one()->id_kelompok;
            $datakelompokkelas = Kelompokkelas::find()->where(['id_kelompok' => $datadetailkelompokkelas])->one()->nama_kelompok;
            $datamatapelajaran = Matapelajaran::find()->where(['id_kelompok' => $datadetailkelompokkelas])->andWhere(['status' => 1])->all();
            // var_dump($datamatapelajaran);die;
        } elseif ($roleValue == 'guru') {
        } else {
        }

        return $this->render('materiuser', [
            'datamatapelajaran' => $datamatapelajaran,
            'datakelompokkelas' => $datakelompokkelas

        ]);
    }

    public function actionMaterinya($nd, $namamapel)
    {
        $datamateri = Materi::find()->where(['id_mapel' => $nd])->all();
        return $this->render('detailmateriuser', [
            'datamateri' => $datamateri,
            'namamapel' => $namamapel
        ]);
    }
}
