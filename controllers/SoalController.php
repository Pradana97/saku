<?php

namespace app\controllers;

use app\models\Detailkelompokkelas;
use app\models\Jawaban;
use app\models\Jawabanuser;
use app\models\Jawabanuseruraian;
use app\models\Kelompokkelas;
use app\models\Matapelajaran;
use app\models\Materi;
use app\models\Murid;
use Yii;
use app\models\Soal;
use app\models\SoalSearch;
use app\models\Ujikompetensi;
use yii\web\{Controller, Response, NotFoundHttpException, UploadedFile};
use yii\filters\VerbFilter;
use yii\helpers\{Html, Url, ArrayHelper};

class SoalController extends Controller
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
        $searchModel = new SoalSearch();
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
                'title' => "Soal #" . $id,
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
        $model = new Soal();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Soal",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Create new Soal",
                    'content' => '<span class="text-success">Create Soal success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])

                ];
            } else {
                return [
                    'title' => "Create new Soal",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_soal]);
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
                    'title' => "Update Soal #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Soal #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])
                ];
            } else {
                return [
                    'title' => "Update Soal #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_soal]);
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
        if (($model = Soal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionSoaluser()
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

        return $this->render('soaluser', [
            'datamatapelajaran' => $datamatapelajaran,
            'datakelompokkelas' => $datakelompokkelas

        ]);
    }

    public function actionUjikompetensinya($nd, $namamapel)
    {
        $datamateri = Ujikompetensi::find()->where(['id_mapel' => $nd])->all();
        if (empty($datamateri)) {
            Yii::$app->session->setFlash('warning', 'Data materi tidak ditemukan.');
        }
        return $this->render('detailmateriuser', [
            'datamateri' => $datamateri,
            'namamapel' => $namamapel
        ]);
    }

    public function actionPilihmateri($nd, $namamapel)
    {
        $datamateri = Materi::find()->where(['id_mapel' => $nd])->all();
        if (empty($datamateri)) {
            Yii::$app->session->setFlash('warning', 'Data materi tidak ditemukan.');
        }
        return $this->render('detailmateriluser', [
            'datamateri' => $datamateri,
            'namamapel' => $namamapel
        ]);
    }


    public function actionPilihujikompetensi($nd)
    {
        $ujikompetensi = Ujikompetensi::find()->where(['id_materi' => $nd])->all();

        if (empty($ujikompetensi)) {
            Yii::$app->session->setFlash('warning', 'Data ujikompetensi tidak ditemukan.');
        }

        return $this->render('ujikompetensi', [
            'ujikompetensi' => $ujikompetensi
        ]);
    }

    public function actionSoal($nd, $jenis, $judul)
    {
        $userId = Yii::$app->user->identity->id;
        if ($jenis == 'ganda') {
            $soal = Soal::find()->where(['id_uji' => $nd])->andWhere(['status' => 1])->all();
            $jawabuser = Jawabanuser::find()->where(['id_uji' => $nd])->andWhere(['user_id' => $userId])->one();
            $idmat = Ujikompetensi::find()->where(['id_uji' => $jawabuser->id_uji])->one()->id_materi;
            if (!empty($jawabuser)) {
                Yii::$app->session->setFlash('success', 'Soal sudah di kerjakan');
                return $this->redirect(['pilihujikompetensi', 'nd' => $idmat]);
            } else {
                if (empty($soal)) {
                    Yii::$app->session->setFlash('warning', 'Data materi tidak ditemukan.');
                }
                return $this->render('soalganda', [
                    'soal' => $soal,
                    'judul' => $judul,
                    'nd' => $nd,

                ]);
            }
        } else {
            $request = Yii::$app->request;

            $model = Jawabanuseruraian::findOne(['id_uji' => $nd, 'user_id' => $userId]) ?? new Jawabanuseruraian();
            if ($model->dokumen != null || $model->dokumen != '') {
                $oldfile = $model->dokumen;
            }
            $isNew = $model->isNewRecord;

            if ($model->load($request->post())) {
                $ujikompetensi = Ujikompetensi::find()->where(['id_uji' => $nd])->one()->id_materi;
                $pdf = UploadedFile::getInstance($model, 'dokumen');

                if ($isNew) {
                    $model->id_uji = $nd;
                    $model->user_id = $userId;
                }

                if (!empty($pdf)) {
                    // Hapus file lama jika ada dan ini bukan new record
                    if (!$isNew && !empty($oldfile)) {
                        unlink(Yii::$app->basePath . '/web/uploads/jawabanuser/' . $model->id_jawabanuser . $oldfile);
                    }

                    $model->dokumen = $pdf;
                } else {
                    Yii::$app->session->setFlash('warning', 'File PDF belum di Uploads');
                    return $this->redirect(['pilihujikompetensi', 'nd' => $ujikompetensi]);
                }

                if ($model->save(false)) {
                    if (!empty($pdf)) {
                        $pdf->saveAs(Yii::$app->basePath . '/web/uploads/jawabanuser/' . $model->id_jawabanuser . $pdf->name);
                    }

                    Yii::$app->session->setFlash('success', "File Jawaban Sudah Tersimpan");
                    return $this->redirect(['pilihujikompetensi', 'nd' => $ujikompetensi]);
                }
            }
            $soal = Soal::find()->where(['id_uji' => $nd])->andWhere(['status' => 1])->all();
            if (empty($soal)) {
                Yii::$app->session->setFlash('warning', 'Data materi tidak ditemukan.');
            }

            return $this->render('soaluraianuser', [
                'soal' => $soal,
                'judul' => $judul,
                'model' => $model,
            ]);
        }
    }

    public function actionSimpanJawaban()
    {
        $request = Yii::$app->request;
        $post = $request->post();
        $userId = Yii::$app->user->identity->id;

        $idUji = $post['id_uji'] ?? null;
        $jawabanUser = $post['Jawabanuserganda'] ?? [];

        foreach ($jawabanUser as $id_soal => $id_jawaban) {
            $jawabanModel = \app\models\Jawaban::findOne($id_jawaban);
            if (!$jawabanModel) {
                continue;
            }

            $model = \app\models\Jawabanuser::find()
                ->where(['id_soal' => $id_soal, 'user_id' => $userId])
                ->one();

            if (!$model) {
                $model = new \app\models\Jawabanuser();
                $model->id_soal = $id_soal;
                $model->user_id = $userId;
            }

            $model->id_jawaban = $id_jawaban;
            $model->apa_benar = $jawabanModel->apa_benar;
            $model->id_uji = $idUji;
            $model->save(false);
        }

        $idMateri = \app\models\Ujikompetensi::find()
            ->where(['id_uji' => $idUji])
            ->one()
            ->id_materi;

        // Kalau via AJAX, kirim JSON dan URL redirect
        if ($request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'success' => true,
                'redirectUrl' => \yii\helpers\Url::to(['pilihujikompetensi', 'nd' => $idMateri])
            ];
        }

        // Kalau bukan AJAX (backup)
        Yii::$app->session->setFlash('success', 'Jawaban berhasil disimpan.');
        return $this->redirect(['pilihujikompetensi', 'nd' => $idMateri]);
    }
}
