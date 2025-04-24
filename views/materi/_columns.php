<?php

use app\models\Matapelajaran;
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
    //     'attribute' => 'id_materi',
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
        'attribute' => 'nama_materi',
    ],
    [
        'attribute' => 'created_date',
        'label' => 'Tgl Upload',
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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'keterangan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dokumen',
        'format' => 'raw',
        'value' => function ($model) {
            $url = Url::to('@web/uploads/materi/' . $model->id_materi . $model->dokumen, true);
            return Html::a('Download', 'javascript:void(0);', [
                'onclick' => "window.open('{$url}', '_blank')",
                'class' => 'btn btn-primary btn-xs'
            ]);
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
                $t = '@web/materi/view?id=' . $model->id_materi;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/materi/update?id=' . $model->id_materi;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/materi/delete?id=' . $model->id_materi;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote',
                    'data-target' => '#' . $model->hash,
                    'title' => 'Delete',
                    'data-confirm' => false,
                    'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Verifikasi?',
                    'data-confirm-message' => 'Anda Yakin Menghapus File Ini ?'
                ]);
            },
        ],
    ],

];
