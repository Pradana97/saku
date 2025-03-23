<?php

use app\models\MsJurusan;
use app\models\MsKelas;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\{Url, Html};

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
    //     'attribute' => 'id_murid',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'no_induk_sekolah',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'no_identitas',
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'tgl_lahir',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'tempat_lahir',
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'jenis_kelamin',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'alamat',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'no_tlp_ortu',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kelas',
        'value' => 'kelas0.nama_kelas',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(MsKelas::find()->where(['status' => 1])->all(), 'id_kelas', 'nama_kelas'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih..'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'jurusan',
        'value' => 'jurusan0.nama_jurusan',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(MsJurusan::find()->where(['status' => 1])->all(), 'id_jurusan', 'nama_jurusan'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih..'],
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'tahun_masuk',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'status',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'nama_ortu',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'status_beasiswa',
    // ],
    [
        'attribute' => 'foto',
        'format' => 'html',
        'value' => function ($data) {
            return Html::img(
                Yii::getAlias('@web') . '/uploads/murid/' . $data->id_murid . $data->foto,
                ['width' => '100px']
            );
        },
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'catatan',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'user_id',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $t = '@web/murid/view?id=' . $model->id_murid;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/murid/update?id=' . $model->id_murid;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/murid/delete?id=' . $model->id_murid;
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
