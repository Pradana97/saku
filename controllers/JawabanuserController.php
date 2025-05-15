<?php

namespace app\controllers;

use app\models\Detailkelompokkelas;
use Yii;
use app\models\Jawabanuser;
use app\models\JawabanuserSearch;
use app\models\Jawabanuseruraian;
use app\models\Kelompokkelas;
use app\models\Matapelajaran;
use app\models\Murid;
use app\models\Soal;
use app\models\Ujikompetensi;
use yii\web\{Controller, Response, NotFoundHttpException};
use yii\filters\VerbFilter;
use yii\helpers\{Html, Url, ArrayHelper};

class JawabanuserController extends Controller
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
        $searchModel = new JawabanuserSearch();
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
                'title' => "Jawabanuser #" . $id,
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
        $model = new Jawabanuser();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Jawabanuser",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Create new Jawabanuser",
                    'content' => '<span class="text-success">Create Jawabanuser success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])

                ];
            } else {
                return [
                    'title' => "Create new Jawabanuser",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_jawabanuser]);
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
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Jawabanuser #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Jawabanuser #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])
                ];
            } else {
                return [
                    'title' => "Update Jawabanuser #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_jawabanuser]);
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
        if (($model = Jawabanuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionJawabanuser()
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

        return $this->render('jawabanuser', [
            'datamatapelajaran' => $datamatapelajaran,
            'datakelompokkelas' => $datakelompokkelas

        ]);
    }

    public function actionUjikompetensinya($nd, $namamapel)
    {
        $data = Jawabanuser::find()
            ->select([
                'uk.nama_ujikompetensi AS namauji',
                'COUNT(*) AS total_jawaban',
                'uk.id_mapel',
                'm.nama_materi AS namamateri',
                'ju.user_id',
                'uk.id_uji'
            ])
            ->alias('ju')
            ->leftJoin('uji_kompetensi uk', 'ju.id_uji = uk.id_uji')
            ->leftJoin('materi m', 'uk.id_materi = m.id_materi')
            ->where([
                'uk.id_mapel' => $nd,
                'ju.user_id' => Yii::$app->user->identity->id
            ])

            ->groupBy([
                'ju.id_uji',
                'uk.id_mapel',
                'uk.id_materi',
                'ju.user_id'
            ])
            ->asArray()
            ->all();

        $data2 = Jawabanuseruraian::find()
            ->alias('juu')
            ->select([
                'm.nama_materi',
                'uk.nama_ujikompetensi',
                'juu.nilai',
                'juu.id_jawabanuser',
                'juu.dokumen',
                'juu.user_id'
            ])
            ->leftJoin('uji_kompetensi uk', 'juu.id_uji = uk.id_uji')
            ->leftJoin('materi m', 'uk.id_materi = m.id_materi')
            ->where([
                'uk.id_mapel' => $nd,
                'juu.user_id' => Yii::$app->user->identity->id
            ])

            ->asArray()
            ->all();

        return $this->render('usermenjawab', [
            // 'datamateri' => $datamateri,
            'namamapel' => $namamapel,
            'data' => $data,
            'data2' => $data2
        ]);
    }

    public function actionCetakganda($nd)
    {
        $soal = Soal::find()->where(['id_uji' => $nd])->all();
        $datamurid = Murid::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

        $pdf = Yii::$app->pdf;
        $pdf->content = $this->renderPartial('jawabangandapdf', ['soal' => $soal, 'datamurid' => $datamurid]);
        $pdf->orientation = 'P';
        $pdf->marginTop = 6;
        $pdf->marginBottom = 4;
        $pdf->marginHeader = 2;
        $pdf->marginFooter = 2;
        $pdf->marginLeft = 6;
        $pdf->marginRight = 6;
        $pdf->cssInline = '.thead{border: 1px solid #0003;text-align: center;font-weight: bold;background:#eee;}.tbody{padding:2px;}#tb1 tr:nth-child(even) {background: #eee}#tb1 tr:nth-child(odd) {background: #FFF}.images{width : 50px;}';
        $pdf->methods = [];
        return $pdf->render();
    }
}
