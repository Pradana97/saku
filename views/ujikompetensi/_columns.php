<?php

use app\models\Matapelajaran;
use app\models\Materi;
use yii\helpers\{Url, Html};
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;


return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'id_uji',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_mapel',
        'value' => 'mapel.msmapel.nama',
        'label' => 'Mata Pelajaran',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(
            Matapelajaran::find()->where(['status' => '1'])->all(),
            'id_mapel',
            function ($model) {
                return $model->msmapel->nama; // pastikan relasinya benar
            },
            function ($model) {
                return $model->kelompok->nama_kelompok; // juga pastikan relasinya benar
            }
        ),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih..'],
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_materi',
        'value' => 'materi.nama_materi',
        'label' => 'Materi',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(
            \app\models\Materi::find()
                ->andFilterWhere(['id_mapel' => $searchModel->id_mapel])
                ->all(),
            'id_materi',
            'nama_materi'
        ),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih Materi'],
    ],



    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Nama Uji Kompetensi',
        'attribute' => 'nama_ujikompetensi',
    ],
    [
        'attribute' => 'tanggal_dibuat',
        // 'label' => 'Tanggal dibuat',
        'format' => ['date', 'php:d-m-Y'],
        'filterType' => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'size' => 'xs',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoWidget' => true,
                'autoclose' => true,
                'todayHighlight' => true
            ]
        ],
    ],
    [
        'attribute' => 'tanggal_akhir',
        // 'label' => 'Tanggal Akhir',
        'format' => ['date', 'php:d-m-Y'],
        'filterType' => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'size' => 'xs',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoWidget' => true,
                'autoclose' => true,
                'todayHighlight' => true
            ]
        ],
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'keterangan',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'value' => function ($model) {
            return $model->status === 'uraian' ? 'Uraian' : ($model->status === 'ganda' ? 'Pilihan Ganda' : '-');
        },
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' => [
            'uraian' => 'Uraian',
            'ganda' => 'Pilihan Ganda',
        ],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih jenis...'],
        'label' => 'Jenis Soal',
    ],


    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{view}{update2}',
        'buttons' => [
            'view' => function ($url, $model) {
                return Html::a(
                    '<span class="fa fa-users"> SOAL LATIHAN</span>',
                    $url,
                    ['data-pjax' => 0, 'title' => 'BUAT SOAL', 'class' => 'btn btn-info btn-xs']
                );
            },

        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                return Url::toRoute(['ujikompetensi/soal', 'nd' => $model->id_uji, 'status' => $model->status]);
            }
        },
    ],


    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $t = '@web/ujikompetensi/view?id=' . $model->id_uji;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/ujikompetensi/update?id=' . $model->id_uji;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/ujikompetensi/delete?id=' . $model->id_uji;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote',
                    'data-target' => '#' . $model->hash,
                    'title' => 'Delete',
                    'data-confirm' => false,
                    'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Are you sure?',
                    'data-confirm-message' => 'Are you sure want to delete this item'
                ]);
            },
        ],
    ],

];
