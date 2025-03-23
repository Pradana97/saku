<?php

use app\models\MsJabatan;
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
    //     'attribute' => 'id_pegawai',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nik',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nip',
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'tgl_lahir',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'jenis_kelamin',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'alamat',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'no_tlp',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'email',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'jabatan',
        'value' => 'jabatan0.nama_jabatan',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(MsJabatan::find()->where(['status' => 1])->all(), 'id_jabatan', 'nama_jabatan'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih..'],
    ],
    [
        'attribute' => 'foto',
        'format' => 'html',
        'value' => function ($data) {
            return Html::img(
                Yii::getAlias('@web') . '/uploads/pegawai/' . $data->id_pegawai . $data->foto,
                ['width' => '100px']
            );
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
                $t = '@web/pegawai/view?id=' . $model->id_pegawai;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/pegawai/update?id=' . $model->id_pegawai;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/pegawai/delete?id=' . $model->id_pegawai;
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
