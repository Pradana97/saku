<?php

namespace app\controllers;

use app\models\Jawaban;
use app\models\Soal;
use Yii;
use app\models\Ujikompetensi;
use app\models\UjikompetensiSearch;
use yii\web\{Controller, Response, NotFoundHttpException};
use yii\filters\VerbFilter;
use yii\helpers\{Html, Url, ArrayHelper};

class UjikompetensiController extends Controller
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
        $searchModel = new UjikompetensiSearch();
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
                'title' => "Ujikompetensi #" . $id,
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
        $model = new Ujikompetensi();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Ujikompetensi",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Create new Ujikompetensi",
                    'content' => '<span class="text-success">Create Ujikompetensi success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])

                ];
            } else {
                return [
                    'title' => "Create new Ujikompetensi",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_uji]);
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
                    'title' => "Update Ujikompetensi #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . $model->hash . '-pjax',
                    'title' => "Ujikompetensi #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . $model->hash])
                ];
            } else {
                return [
                    'title' => "Update Ujikompetensi #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_uji]);
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
        if (($model = Ujikompetensi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetByMapel($id_mapel)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $materi = \app\models\Materi::find()
            ->where(['id_mapel' => $id_mapel])
            ->all();

        return ArrayHelper::map($materi, 'id_materi', 'nama_materi');
    }

    public function actionSoal($nd, $status)
    {
        $request = Yii::$app->request;
        $model = new Soal();
        $modelsJawaban = [
            new Jawaban(), // A
            new Jawaban(), // B
            new Jawaban(), // C
            new Jawaban(), // D
        ];
        $title = Ujikompetensi::find()->where(['id_uji' => $nd])->one()->nama_ujikompetensi;
        if ($model->load($request->post())) {
            // return $this->redirect(['view', 'id' => $model->id_uji]);
        } else {
            if ($status == 'uraian') {
                return $this->render('soaluraian', [
                    'nd' => $nd,
                    'model' => $model,
                    'judul' => $title,
                ]);
            } else {
                return $this->render('soalganda', [
                    'nd' => $nd,
                    'model' => $model,
                    'judul' => $title,
                    'modelsJawaban' => $modelsJawaban
                ]);
            }
        }
    }

    public function actionSavesoal($id_uji, $type)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new \app\models\Soal();
        $model->load(Yii::$app->request->post());
        $model->id_uji = $id_uji;
        $model->type = $type;

        if ($model->save()) {
            $jumlah = Soal::find()->where(['id_uji' => $id_uji])->count();
            return [
                'success' => true,
                'id' => $model->id_soal,
                'soal' => $model->soal,
                'status' => $model->status, // Tambahkan ini
                'no' => $jumlah
            ];
        }

        return ['success' => false];
    }

    public function actionDeletesoal()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id'); // Ambil ID dari POST body

        if (!$id) {
            return ['success' => false, 'message' => 'ID tidak ditemukan'];
        }

        $model = Soal::findOne($id);

        if ($model && $model->delete()) {
            return [
                'success' => true,
                'id' => $id,
            ];
        }

        return ['success' => false];
    }

    public function actionTogglestatus()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        if (!$id) {
            return ['success' => false, 'message' => 'ID tidak ditemukan'];
        }

        $model = Soal::findOne($id);

        if ($model) {
            $model->status = $model->status == 1 ? 0 : 1;
            if ($model->save(false)) {
                return [
                    'success' => true,
                    'status' => $model->status,
                    'id' => $model->id_soal
                ];
            }
        }

        return ['success' => false];
    }

    public function actionEditsoal()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $newSoal = Yii::$app->request->post('soal');

        $model = \app\models\Soal::findOne($id);
        if (!$model) {
            return ['success' => false, 'message' => 'Data tidak ditemukan'];
        }

        $model->soal = $newSoal;
        if ($model->save(false)) {
            return ['success' => true];
        }

        return ['success' => false];
    }

    public function actionSavesoalganda($nd, $type)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $model = new Soal();
        $model->id_uji = $nd;

        $modelsJawaban = [
            new Jawaban(),
            new Jawaban(),
            new Jawaban(),
            new Jawaban(),
        ];

        if ($model->load($request->post())) {
            $model->type = $type;
            $model->save();

            $jawabanData = $request->post('Jawaban', []);
            foreach ($modelsJawaban as $i => $jawaban) {
                $jawaban->attributes = $jawabanData[$i];
                $jawaban->id_soal = $model->id_soal;
                $jawaban->save(false);
            }

            // Ambil ulang semua soal untuk refresh tampilan
            $soal = Soal::find()->where(['id_uji' => $nd])->all();

            // Buat potongan HTML tabel soal dari dalam controller (tanpa render file view baru)
            ob_start();
            $no = 1;
            foreach ($soal as $row) {
                echo "<tr>";
                echo "<td style='width:5% ; font-weight: bold; text-align: center; font-size: 16px;'>{$no}</td>";
                echo "<td style='width:65% ; font-weight: bold; font-size: 16px;'>{$row->soal}</td>";
                echo "<td style=width:10% ; font-weight: bold;text-align: center; font-size: 16px;'>{$row->status}</td>";
                echo "<td style='width:10%;'>" . Html::a('<button class=\"btn btn-primary btn-md\">Update</button>', ['ujikompetensi/update', 'id' => $row->id_soal]) . "</td>";
                echo "<td style='width:10%;'>" . Html::a('<button class=\"btn btn-danger btn-md\">Hapus</button>', ['ujikompetensi/delete', 'id' => $row->id_soal], ['data' => ['confirm' => 'Yakin ingin menghapus?', 'method' => 'post']]) . "</td>";
                echo "</tr>";

                echo "<tr><td colspan='5'>";
                echo "<table style='width:100%; background:#f9f9f9; margin-top:10px;'><thead><tr><th style='width:10%; text-align:center;'>Label</th><th style='width:70%;'>Jawaban</th><th style='width:20%; text-align:center;'>Keterangan</th></tr></thead><tbody>";

                $jawaban = Jawaban::find()->where(['id_soal' => $row->id_soal])->all();
                foreach ($jawaban as $i => $row2) {
                    $label = chr(65 + $i);
                    $keterangan = $row2->apa_benar === 'Y'
                        ? '<span style="color:green; font-weight:bold;">✔ Benar</span>'
                        : '<span style="color:red;">✘ Salah</span>';
                    echo "<tr><td style='text-align:center;'>{$label}</td><td>{$row2->jawab}</td><td style='text-align:center;'>{$keterangan}</td></tr>";
                }

                echo "<tr><td colspan='3'><hr></td></tr>";
                echo "</tbody></table></td></tr>";
                $no++;
            }
            $soalHtml = ob_get_clean();

            return [
                'status' => 'success',
                'soalHtml' => $soalHtml
            ];
        }

        return ['status' => 'error'];
    }
}
